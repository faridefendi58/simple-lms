<?php

namespace App\Repositories;

use App\Http\Requests\StoreBookRequest;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository implements BookRepositoryInterface
{
    /**
     * List of books
     *
     * @param Request $request
     * @return LengthAwarePaginator<Book>
     */
    public function index(Request $request): LengthAwarePaginator
    {
        $query = Book::query();
        $query->with('author');
        // if author_id is passed, filter by it
        if ($request->has('author_id')) {
            $query->where('author_id', $request->get('author_id'));
        }
        // if title is passed, filter by it
        if ($request->has('title') && is_string($title = $request->get('title', ''))) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        $query->orderBy('created_at', 'DESC');

        return $query->paginate($request->get('per_page', 10));
    }

    public function store(StoreBookRequest $request): Book
    {
        return Book::create(
            $request->only('title', 'description', 'publish_date', 'author_id')
        );
    }

    public function update(Request $request, Model $book): bool
    {
        return $book->update(
            $request->only('title', 'description', 'publish_date', 'author_id')
        );
    }

    public function delete(Model $book): ?bool
    {
        return $book->delete();
    }
}
