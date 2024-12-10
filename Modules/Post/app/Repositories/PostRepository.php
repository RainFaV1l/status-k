<?php

namespace Modules\Post\Repositories;

use Communicators\Auth\AuthCommunicator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Modules\Post\Filters\PostFilter;
use Modules\Post\Interfaces\PostRepositoryInterface;
use Modules\Post\Models\Post;
use Modules\Post\Models\PostCategory;

class PostRepository implements PostRepositoryInterface
{
    private AuthCommunicator $authCommunicator;

    public function __construct(AuthCommunicator $authCommunicator)
    {

        $this->authCommunicator = $authCommunicator;
    }

    public function store(array $data): void
    {
        Post::query()->create($data);
    }

    public function destroy(int $id): void
    {
        Post::query()->where('id', $id)->delete();
    }

    public function update(array $data, int $id): void
    {
        Post::query()->where('id', $id)->update($data);
    }

    public function getPost(int $id): Post
    {
        return Post::query()->findOrFail($id);
    }

    public function getPosts(PostFilter $postFilter): Collection
    {
        return Post::filter($postFilter)->get();
    }

    public function getPublishedPosts(PostFilter $postFilter, $paginate = 0): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if ($paginate != 0) {
            return Post::filter($postFilter)->where('is_published', true)->paginate($paginate);
        }

        return Post::filter($postFilter)->where('is_published', true)->get();
    }

    public function getPostsBuilder(): Builder
    {
        return Post::query();
    }

    public function getCategories(): Collection
    {
        return PostCategory::all();
    }

    public function getAuthors(): \Illuminate\Support\Collection
    {
        return $this->authCommunicator->getUserBuilder()->has('posts')->get();
    }
}
