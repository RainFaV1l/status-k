<?php

namespace Modules\Auth\Services;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Exceptions\InvalidCredentialsException;
use Modules\Auth\Models\User;
use Modules\Auth\Repositories\AuthRepository;
use Communicators\Auth\AuthCommunicator;
use Modules\Auth\Filters\UserFilter;

class AuthService implements AuthCommunicator
{
    public AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param FormRequest $request
     * @return true
     * @throws InvalidCredentialsException
     */
    public function login(FormRequest $request): true
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return true;
        }

        logger()->warning('Неудачная попытка входа', ['email' => $credentials['email'] ?? 'unknown']);

        throw new InvalidCredentialsException();
    }

    public function register(FormRequest $request): void
    {
        $data = $request->validated();

        $user = $this->authRepository->create($data);

        auth()->login($user);

        $request->session()->regenerate();
    }

    public function logout(): void
    {
        auth()->logout();

        session()->invalidate();

        session()->regenerateToken();
    }

    public function getUsers(): \Illuminate\Database\Eloquent\Collection
    {
        return User::query()->get();
    }

    public function getUserBuilder(): \Illuminate\Database\Eloquent\Builder
    {
        return User::query();
    }

    public function getFilteredUsers(UserFilter $userFilter): \Illuminate\Database\Eloquent\Collection
    {
        return User::filter($userFilter)->get();
    }
}
