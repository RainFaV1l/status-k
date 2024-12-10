<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Communicators\Post\PostCommunicator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Modules\Auth\Exceptions\InvalidCredentialsException;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Services\AuthService;

class AuthController extends Controller
{
    public AuthService $authService;

    public function __construct(AuthService $authService, PostCommunicator $postCommunicator)
    {
        $this->authService = $authService;
    }

    /**
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function loginView()
    {
        return view('auth::login');
    }

    /**
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function registerView()
    {
        return view('auth::register');
    }


    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        try {

            $this->authService->login($request);

            if(!auth()->user()->hasVerifiedEmail()) {
                $request->user()->sendEmailVerificationNotification();
            }

            return redirect()->route('auth.profile');

        } catch (InvalidCredentialsException $exception) {
            return redirect()->back()->withInput()->withErrors(['password' => $exception->getMessage()]);
        }
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $this->authService->register($request);

        $request->user()->sendEmailVerificationNotification();

        return redirect()->route('auth.profile');
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function logout()
    {
        $this->authService->logout();

        return redirect()->route('home.index');
    }

    public function profile()
    {
        return view('auth::profile');
    }
}
