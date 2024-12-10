@extends('auth::layouts.master')

@section('content')
    <div class="bg-white">
        <x-home::header page="register"/>
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Регистрация</h2>
            </div>
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <x-form class="space-y-6" action="{{ route('auth.register') }}">
                    <div>
                        <x-label for="ФИО" class="block text-sm/6 font-medium text-gray-900"/>
                        <div class="mt-2">
                            <x-input name="full_name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="full_name" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <x-label for="email" class="block text-sm/6 font-medium text-gray-900"/>
                        <div class="mt-2">
                            <x-email class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="email" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <x-label for="пароль" class="block text-sm/6 font-medium text-gray-900"/>
                        </div>
                        <div class="mt-2">
                            <x-password class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="password" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <x-label for="подтвердите пароль" class="block text-sm/6 font-medium text-gray-900"/>
                        </div>
                        <div class="mt-2">
                            <x-password name="password_confirmation" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="password_confirmation" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Создать</button>
                    </div>
                </x-form>
            </div>
        </div>

    </div>
@endsection
