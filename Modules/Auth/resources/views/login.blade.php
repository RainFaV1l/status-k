@extends('auth::layouts.master')

@section('content')
    <div class="bg-white">
        <x-home::header page="login"/>
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Авторизация</h2>
            </div>
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <x-form method="POST" action="{{ route('auth.login') }}" class="space-y-6">
                    <div>
                        <x-label for="email" class="block text-sm/6 font-medium text-gray-900"/>
                        <div class="mt-2">
                            <x-email
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="email" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <x-label for="Пароль" class="block text-sm/6 font-medium text-gray-900"/>
                            {{--                            <div class="text-sm">--}}
                            {{--                                <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Забыли пароль?</a>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="mt-2">
                            <x-password
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="password" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Войти
                        </button>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
