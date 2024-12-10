<?php

namespace Communicators\Auth;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Exceptions\InvalidCredentialsException;
use Modules\Auth\Filters\UserFilter;

interface AuthCommunicator
{
    /**
     * @throws InvalidCredentialsException
     */
    public function login(FormRequest $request);

    public function register(FormRequest $request);
    public function logout();
    public function getUsers();
    public function getUserBuilder(): Builder;
    public function getFilteredUsers(UserFilter $userFilter);
}
