<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * API endpoint to get LearningCenter data with token authentication
     * URL: /data/{token}?query=params
     */
    public function data(Request $request, $token): JsonResponse
    {
        // Validate token
        $tokenModel = Token::where('token', $token)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->first();

        if (!$tokenModel) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid or expired token'
            ], 401);
        }

        // Validate query parameters
        $validated = $request->validate([
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'radius' => 'nullable|numeric',
            'searchText' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'name' => 'nullable|in:asc,desc',
            'distance' => 'nullable|in:asc,desc',
            'favorites' => 'nullable|in:asc,desc',
            'sort' => 'nullable|in:name,distance,favorites,rating,created',
            'order' => 'nullable|in:asc,desc',
            'checked' => 'nullable|in:0,1',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'dayMode' => 'nullable|in:true',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:50',
        ]);

        // Build query
        $query = LearningCenter::query();

        // Search text filter
        if (!empty($validated['searchText'])) {
            $searchTerm = $validated['searchText'];
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('about', 'like', '%' . $searchTerm . '%')
                  ->orWhere('address', 'like', '%' . $searchTerm . '%')
                  ->orWhere('province', 'like', '%' . $searchTerm . '%')
                  ->orWhere('region', 'like', '%' . $searchTerm . '%');
            });
        }

        // Type filter
        if (!empty($validated['type'])) {
            $query->where('type', $validated['type']);
        }

        // Checked filter
        if (isset($validated['checked'])) {
            $query->where('checked', $validated['checked']);
        }

        // Price range filter
        if (!empty($validated['min_price']) || !empty($validated['max_price'])) {
            $query->whereHas('subjects', function ($q) use ($validated) {
                if (!empty($validated['min_price'])) {
                    $q->where('price', '>=', $validated['min_price']);
                }
                if (!empty($validated['max_price'])) {
                    $q->where('price', '<=', $validated['max_price']);
                }
            });
        }

        // Distance filter (if coordinates provided)
        if (!empty($validated['latitude']) && !empty($validated['longitude'])) {
            $lat = $validated['latitude'];
            $lng = $validated['longitude'];
            $radius = $validated['radius'] ?? 50; // default 50km

            $query->selectRaw(
                "*, (6371 * acos(cos(radians(?)) * cos(radians(SUBSTRING_INDEX(location, ',', 1))) * cos(radians(SUBSTRING_INDEX(location, ',', -1)) - radians(?)) + sin(radians(?)) * sin(radians(SUBSTRING_INDEX(location, ',', 1))))) AS distance",
                [$lat, $lng, $lat]
            )->having('distance', '<=', $radius);
        }

        // Sorting
        $sortField = $validated['sort'] ?? 'created_at';
        $sortOrder = $validated['order'] ?? 'desc';

        // Handle legacy sort parameters
        if (!empty($validated['name'])) {
            $sortField = 'name';
            $sortOrder = $validated['name'];
        } elseif (!empty($validated['distance'])) {
            $sortField = 'distance';
            $sortOrder = $validated['distance'];
        } elseif (!empty($validated['favorites'])) {
            $sortField = 'favorites_count';
            $sortOrder = $validated['favorites'];
        }

        // Apply sorting
        if ($sortField === 'distance' && !empty($validated['latitude']) && !empty($validated['longitude'])) {
            $query->orderBy('distance', $sortOrder);
        } elseif ($sortField === 'favorites') {
            $query->withCount('favorites')->orderBy('favorites_count', $sortOrder);
        } elseif ($sortField === 'rating') {
            $query->orderBy('rating', $sortOrder);
        } elseif ($sortField === 'created') {
            $query->orderBy('created_at', $sortOrder);
        } else {
            $query->orderBy($sortField, $sortOrder);
        }

        // Pagination
        $perPage = $validated['per_page'] ?? 20;
        $page = $validated['page'] ?? 1;

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        // Transform results
        $centers = collect($paginator->items())->map(function ($center) {
            $coords = [];
            if (!empty($center->location) && is_string($center->location)) {
                $coords = array_map('trim', explode(',', $center->location));
            }

            $image = null;
            if (!empty($center->logo)) {
                $image = (str_starts_with($center->logo, 'http://') || str_starts_with($center->logo, 'https://'))
                    ? $center->logo
                    : asset('storage/' . $center->logo);
            }

            return [
                'id' => $center->id,
                'slug' => $center->slug,
                'name' => $center->name,
                'type' => $center->type,
                'about' => $center->about,
                'province' => $center->province,
                'region' => $center->region,
                'address' => $center->address,
                'lat' => (float) ($coords[0] ?? 0),
                'lng' => (float) ($coords[1] ?? 0),
                'image' => $image,
                'rating' => (float) ($center->rating ?? 0),
                'total_reyting' => (float) ($center->total_reyting ?? 0),
                'student_count' => (int) ($center->student_count ?? 0),
                'checked' => (bool) $center->checked,
                'premium' => (bool) $center->premium,
                'distance' => isset($center->distance) ? round((float) $center->distance, 2) : null,
                'created_at' => $center->created_at?->format('Y-m-d H:i:s'),
                'detail_url' => !empty($center->slug) ? route('center', $center->slug) : null,
            ];
        })->values();

        return response()->json([
            'success' => true,
            'data' => $centers,
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
                'has_more_pages' => $paginator->hasMorePages(),
            ],
            'token_info' => [
                'token_name' => $tokenModel->name,
                'expires_at' => $tokenModel->expires_at?->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}