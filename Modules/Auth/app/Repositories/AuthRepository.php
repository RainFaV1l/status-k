<?php

namespace Modules\Auth\Repositories;

use Modules\Auth\Interfaces\AuthRepositoryInterface;
use Modules\Auth\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function create(array $data): User {
        return User::query()->create($data);
    }
}
