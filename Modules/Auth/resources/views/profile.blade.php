@extends('home::layouts.master')

@section('content')
    <div class="bg-white">
        <x-home::header page="profile"/>
        <hr class="border-t border-gray-300 my-4">
        <h1 class="text-5xl uppercase text-center mt-4">Профиль</h1>
        <p class="mt-4 text-center">Привет, {{ auth()->user()->email }}</p>
        <hr class="border-t border-gray-300 my-4">
        <div class="mx-auto max-w-2xl py-8 sm:px-6 lg:max-w-7xl px-8">
            <div class="mt-8 flex items-center justify-between">
                <h2 class="text-gray-800 font-medium">Объявления</h2>
                <div class="flex items-center gap-7">
                    <a href="{{ route('post.create') }}" class="flex-none rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Добавить статью</a>
                    <a href="{{ route('chat.index') }}" class="flex-none rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Мои сообщения</a>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @foreach(auth()->user()->posts as $post)
                    <div class="group flex flex-col items-start">
                        <img src="{{ $post->imagePath }}"
                             alt="Tall slender porcelain bottle with natural clay textured body and cork stopper."
                             class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
                        <h3 class="mt-4 text-sm text-gray-700">{{ $post->title }}</h3>
                        <p class="mt-3 text-white py-1 px-4 bg-gray-500 rounded">Категория: {{ $post->category->name }}</p>
                        <p class="mt-3 text-white py-1 px-4 bg-gray-500 rounded">Анонс: {{ \Carbon\Carbon::parse($post->anons)->format('d-m-Y') }}</p>
                        <p class="mt-3 text-white py-1 px-4 bg-gray-500 rounded">{{ \Carbon\Carbon::parse($post->category->created_at)->format('d-m-Y') }}</p>
                        <p class="mt-3 text-white py-1 px-4  rounded {{ $post->is_published ? 'bg-green-500' : 'bg-yellow-500' }}">{{ $post->is_published ? 'Опубликовано' : 'В модерации' }}</p>
                        <div class="flex flex-wrap items-center gap-4 mt-4">
                            <a href="{{ route('post.edit', $post->id) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 transition">Редактировать</a>
                            <x-form-button method="post" action="{{ route('post.destroy', $post->id) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 transition">Удалить</x-form-button>
                            <a href="{{ route('post.show', $post->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Подробнее</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
