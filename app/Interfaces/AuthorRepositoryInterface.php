<?php

namespace App\Interfaces;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface AuthorRepositoryInterface
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator<Author>
     */
    public function index(Request $request): LengthAwarePaginator;
    public function store(StoreAuthorRequest $request): Author;
    public function update(UpdateAuthorRequest $request, Author $author): bool;
    public function delete(Author $author): ?bool;
}
