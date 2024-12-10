<?php

namespace Communicators\Post;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Post\Filters\PostFilter;
use \Illuminate\Support\Collection;

interface PostCommunicator
{
    public function store(FormRequest $request);

    public function update(FormRequest $request, int $id): void;

    public function destroy(int $id);

    public function getPost(int $id);

    public function getPosts(PostFilter $postFilter);
    public function getPublishedPosts(PostFilter $postFilter);
    public function getPostsBuilder() : Builder;
    public function getCategories() : Collection;
}
