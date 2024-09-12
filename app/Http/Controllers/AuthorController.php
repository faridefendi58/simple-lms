<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\BookResource;
use App\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorController extends Controller
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Show list resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return BookResource::collection($this->authorRepository->index($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAuthorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAuthorRequest $request)
    {
        $this->authorRepository->store($request);

        return response()->json([
            'success' => true,
            'message' => __('Your data has been saved successfully')
        ]);
    }

    /**
     * Update the Author resource in storage.
     *
     * @param UpdateAuthorRequest $request
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $response = ['success' => false];
        $success = $this->authorRepository->update($request, $author);
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
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Author $author)
    {
        $this->authorRepository->delete($author);

        return response()->json([
            'success' => true,
            'message' => __('Your data has been deleted successfully')
        ]);
    }
}
