<?php

namespace Modules\Post\Interfaces;

use Illuminate\Support\Collection;
use Modules\Post\Filters\PostFilter;
use Modules\Post\Models\Post;

interface PostRepositoryInterface
{
    public function store(array $data);
    public function update(array $data, int $id): void;
    public function getPost(int $id): Post;
    public function getPosts(PostFilter $postFilter): Collection;
    public function getPublishedPosts(PostFilter $postFilter, $paginate = 10): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator;
    public function getAuthors(): Collection;
}
