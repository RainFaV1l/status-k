<?php

namespace Modules\Auth\Interfaces;

use Modules\Auth\Models\User;

interface AuthRepositoryInterface
{
    public function create(array $data): User;
}
