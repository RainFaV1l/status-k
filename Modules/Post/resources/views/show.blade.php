@extends('home::layouts.master')

@section('content')
    <div class="bg-white">
        <x-home::header page="show"/>
        <hr class="border-t border-gray-300 my-4">
        <div class="bg-white">
            <div class="pt-6">
                <nav aria-label="Breadcrumb">
                    <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                        <li>
                            <div class="flex items-center">
                                <a href="{{ route('post.index') }}" class="mr-2 text-sm font-medium text-gray-900">Статьи</a>
                                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                </svg>
                            </div>
                        </li>
                        <li class="text-sm">
                            <span aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ $post->title }}</span>
                        </li>
                    </ol>
                </nav>

                <!-- Image gallery -->
                <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
                    <img src="{{ $post->imagePath }}" class="hidden aspect-[3/4] size-full rounded-lg object-cover lg:block">
                </div>

                <!-- Product info -->
                <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
                    <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $post->title }}</h1>
                    </div>

                    <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                        <!-- Description and details -->
                        <div>
                            <h3 class="sr-only">Описание</h3>

                            <div class="space-y-6">
                                <p class="text-base text-gray-900">{!! $post->description !!}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <p class="mt-3 text-white py-1 px-4 bg-indigo-500 rounded">Категория: {{ $post->category->name }}</p>
                            <p class="mt-3 text-white py-1 px-4 bg-indigo-500 rounded">Анонс: {{ \Carbon\Carbon::parse($post->anons)->format('d-m-Y') }}</p>
                            <p class="mt-3 text-white py-1 px-4 bg-indigo-500 rounded">{{ \Carbon\Carbon::parse($post->category->created_at)->format('d-m-Y') }}</p>
                        </div>
                        @auth
                            <x-auth::chat :user_id="auth()->user()->id" :author_id="$post->user_id"/>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
