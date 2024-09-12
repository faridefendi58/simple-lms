<?php

namespace App\Interfaces;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookRepositoryInterface
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator<Book>
     */
    public function index(Request $request): LengthAwarePaginator;
    public function store(StoreBookRequest $request): Book;
    public function update(Request $request, Book $book): bool;
    public function delete(Book $book): ?bool;
}
