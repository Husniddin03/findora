<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LearningCenter;
use App\Models\Token;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    /**
     * API endpoint to get LearningCenter data with token authentication
     * URL: /data?query=params&token={token} or Authorization header: Bearer {token}
     */
    public function data(Request $request, SearchService $searchService): JsonResponse
    {
        // Try to get token from Authorization header first
        $authHeader = $request->header('Authorization');
        $token = null;

        if ($authHeader && str_starts_with($authHeader, 'Bearer ')) {
            $token = substr($authHeader, 7);
        }

        // Fallback to query parameter for backward compatibility
        if (!$token && $request->has('token')) {
            $token = $request->query('token');
        }

        if (!$token) {
            return response()->json([
                'success' => false,
                'error' => 'Token required (Authorization: Bearer {token} or ?token={token})'
            ], 401);
        }

        // Validate token in database
        $tokenModel = null;
        try {
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
        } catch (\Exception $e) {
            Log::error('Token validation error', [
                'error' => $e->getMessage(),
                'token' => $token ? substr($token, 0, 10) . '...' : 'null'
            ]);
            return response()->json([
                'success' => false,
                'error' => 'Token validation failed'
            ], 500);
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

        // Build filters for SearchService
        $filters = [
            'searchText' => $validated['searchText'] ?? '',
            'type' => $validated['type'] ?? '',
            'checked' => $validated['checked'] ?? '',
            'min_price' => $validated['min_price'] ?? null,
            'max_price' => $validated['max_price'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'radius' => $validated['radius'] ?? null,
            'sort' => $validated['sort'] ?? '',
            'order' => $validated['order'] ?? 'desc',
            'page' => $validated['page'] ?? 1,
            'per_page' => $validated['per_page'] ?? 20,
        ];

        // Handle legacy sort parameters
        if (!empty($validated['name'])) {
            $filters['sort'] = 'name';
            $filters['order'] = $validated['name'];
        } elseif (!empty($validated['distance'])) {
            $filters['sort'] = 'distance';
            $filters['order'] = $validated['distance'];
        } elseif (!empty($validated['favorites'])) {
            $filters['sort'] = 'favorites';
            $filters['order'] = $validated['favorites'];
        }

        try {
            // Use SearchService for all search logic
            $paginator = $searchService->search($filters);

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
                    'token_name' => $tokenModel ? $tokenModel->name : 'Unknown',
                    'expires_at' => $tokenModel && $tokenModel->expires_at ? $tokenModel->expires_at->format('Y-m-d H:i:s') : null,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('API data error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Server error'
            ], 500);
        }
    }
}