<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Show list resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return BookResource::collection(
            $this->bookRepository->index($request)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBookRequest $request)
    {
        $this->bookRepository->store($request);

        return response()->json([
            'success' => true,
            'message' => __('Your data has been saved successfully')
        ]);
    }

    /**
     * Update method
     *
     * @param Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Book $book)
    {
        $response = ['success' => false];
        $success = $this->bookRepository->update($request, $book);
        $response = [
            'success' => $success,
            'message' => $success ? __('Your data has been updated successfully')
                : __('Failed to save your data')
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book)
    {
        $this->bookRepository->delete($book);

        return response()->json([
            'success' => true,
            'message' => __('Your data has been deleted successfully')
        ]);
    }
}
