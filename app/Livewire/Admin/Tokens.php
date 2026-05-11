<?php

namespace App\Livewire\Admin;

use App\Models\Token;
use Livewire\Component;
use Livewire\WithPagination;

class Tokens extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public int $perPage = 20;

    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public ?Token $editingToken = null;

    public array $form = [
        'name' => '',
        'description' => '',
        'is_active' => true,
        'expires_at' => '',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy(string $field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function create()
    {
        $this->reset('form');
        $this->form['is_active'] = true;
        $this->showCreateModal = true;
    }

    public function store()
    {
        $validated = $this->validate([
            'form.name' => 'required|string|max:255',
            'form.description' => 'nullable|string',
            'form.is_active' => 'boolean',
            'form.expires_at' => 'nullable|date|after:now',
        ]);

        Token::create([
            'name' => $this->form['name'],
            'description' => $this->form['description'],
            'is_active' => $this->form['is_active'],
            'expires_at' => $this->form['expires_at'] ?: null,
            'created_by' => auth()->id(),
        ]);

        $this->showCreateModal = false;
        $this->reset('form');
        session()->flash('message', 'Token yaratildi.');
    }

    public function edit(int $id)
    {
        $this->editingToken = Token::findOrFail($id);
        $this->form = [
            'name' => $this->editingToken->name,
            'description' => $this->editingToken->description,
            'is_active' => $this->editingToken->is_active,
            'expires_at' => $this->editingToken->expires_at ? $this->editingToken->expires_at->format('Y-m-d H:i') : '',
        ];
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'form.name' => 'required|string|max:255',
            'form.description' => 'nullable|string',
            'form.is_active' => 'boolean',
            'form.expires_at' => 'nullable|date|after:now',
        ]);

        $this->editingToken->update([
            'name' => $this->form['name'],
            'description' => $this->form['description'],
            'is_active' => $this->form['is_active'],
            'expires_at' => $this->form['expires_at'] ?: null,
        ]);

        $this->showEditModal = false;
        $this->reset('form', 'editingToken');
        session()->flash('message', 'Token yangilandi.');
    }

    public function toggleStatus(int $id)
    {
        $token = Token::findOrFail($id);
        $token->is_active = !$token->is_active;
        $token->save();
        session()->flash('message', 'Status yangilandi.');
    }

    public function delete(int $id)
    {
        Token::findOrFail($id)->delete();
        session()->flash('message', 'Token o\'chirildi.');
    }

    public function regenerate(int $id)
    {
        $token = Token::findOrFail($id);
        $token->token = \Illuminate\Support\Str::random(64);
        $token->save();
        session()->flash('message', 'Token qayta yaratildi.');
    }

    public function render()
    {
        $query = Token::with('creator');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('token', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->status === 'active') {
            $query->where('is_active', true);
        } elseif ($this->status === 'inactive') {
            $query->where('is_active', false);
        }

        $tokens = $query->orderBy($this->sortField, $this->sortDirection)
                       ->paginate($this->perPage);

        return view('livewire.admin.tokens', [
            'tokens' => $tokens,
        ])->layout('layouts.admin.app', ['title' => 'Tokenlar']);
    }
}
