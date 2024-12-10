<?php

namespace Modules\Post\Services;

use Communicators\Post\PostCommunicator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Modules\Post\Filters\PostFilter;
use Modules\Post\Models\Post;
use Modules\Post\Repositories\PostRepository;

class PostService implements PostCommunicator
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {

        $this->postRepository = $postRepository;
    }

    public function update(FormRequest $request, int $id): void
    {
        $data = $request->validated();

        $post = $this->postRepository->getPost($id);

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');

            if (Storage::exists($post->image)) {
                Storage::delete($post->image);
            }

            Storage::delete('storage/app/public/' . $post->image);
        }

        $post['is_published'] = false;

        $this->postRepository->update($data, $id);

        return;
    }

    public function destroy(int $id)
    {
        $this->postRepository->destroy($id);
    }

    public function getPost(int $id): Post
    {
        return $this->postRepository->getPost($id);
    }

    public function getPosts(PostFilter $postFilter): \Illuminate\Support\Collection
    {
        return $this->postRepository->getPosts($postFilter);
    }

    public function getPublishedPosts(PostFilter $postFilter): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->postRepository->getPublishedPosts($postFilter);
    }

    public function getPublishedPaginatePosts(PostFilter $postFilter): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->postRepository->getPublishedPosts($postFilter, 8);
    }

    public function getPostsBuilder(): Builder
    {
        return $this->postRepository->getPostsBuilder();
    }

    public function getCategories(): \Illuminate\Support\Collection
    {
        return $this->postRepository->getCategories();
    }


    public function getAuthors(): \Illuminate\Support\Collection
    {
        return $this->postRepository->getAuthors();
    }


    public function store(FormRequest $request): void
    {
        $data = $request->validated();

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $data['user_id'] = auth()->id();

        $this->postRepository->store($data);
    }
}
