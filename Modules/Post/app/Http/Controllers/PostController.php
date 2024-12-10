<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Post\Filters\PostFilter;
use Modules\Post\Http\Requests\PostFilterRequest;
use Modules\Post\Http\Requests\StoreRequest;
use Modules\Post\Http\Requests\UpdateRequest;
use Modules\Post\Models\PostCategory;
use Modules\Post\Services\PostService;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {

        $this->postService = $postService;
    }

    public function edit(int $id)
    {
        $categories = $this->postService->getCategories();

        $post = $this->postService->getPost($id);

        return view('post::edit', compact('categories', 'post'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PostFilterRequest $postFilterRequest, PostFilter $postFilter)
    {
        $postFilterRequest->validated();

        $posts = $this->postService->getPublishedPaginatePosts($postFilter);

        $lastPage = $posts->lastPage();

        $currentPage = $posts->currentPage();

        $authors = $this->postService->getAuthors();

        $categories = PostCategory::all();

        return view('post::index', compact('posts', 'categories', 'authors', 'currentPage', 'lastPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->postService->getCategories();

        return view('post::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->postService->store($request);

        session()->flash('success', 'Отправлено на модерацию!');

        return redirect()->route('auth.profile');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $post = $this->postService->getPost($id);

        return view('post::show', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->postService->update($request, $id);

        session()->flash('success', 'Отправлено на модерацию!');

        return redirect()->route('auth.profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->postService->destroy($id);

        session()->flash('success', 'Успешное удаление новости!');

        return redirect()->route('auth.profile');
    }
}
