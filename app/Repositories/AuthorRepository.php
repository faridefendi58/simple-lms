<?php

namespace App\Repositories;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorRepository implements AuthorRepositoryInterface
{
    /**
     * List of authors
     *
     * @param Request $request
     * @return LengthAwarePaginator<Author>
     */
    public function index(Request $request): LengthAwarePaginator
    {
        $query = Author::query();
        $query->with('books');
        // if name is passed, filter by it
        if ($request->has('name') && is_string($title = $request->get('title', ''))) {
            $query->where('name', 'like', '%' . $title . '%');
        }
        $query->orderBy('created_at', 'DESC');

        return $query->paginate($request->get('per_page', 10));
    }

    public function store(StoreAuthorRequest $request): Author
    {
        return Author::create(
            $request->only('name', 'bio', 'birth_date')
        );
    }

    public function update(UpdateAuthorRequest $request, Author $author): bool
    {
        return $author->update(
            $request->only('name', 'bio', 'birth_date')
        );
    }

    public function delete(Author $author): ?bool
    {
        return $author->delete();
    }
}
