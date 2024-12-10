@extends('home::layouts.master')

@section('content')
    <div class="bg-white">
        <x-home::header page="announcements"/>
        <hr class="border-t border-gray-300 my-4">
        <form method="get" action="{{ route('post.filter') }}" class="py-8 sm:px-6 px-8">
            <div class="mt-8 flex items-center justify-between">
                <h2 class="text-gray-800 font-medium">Объявления</h2>
                <div class="flex items-center gap-x-4">
                    <div class="relative flex items-center">
                        <label class="absolute text-sm text-gray-400 -top-7">Автор</label>
                        <select name="user_id" class="cursor-pointer text-gray-800 rounded-md border-0 bg-gray-100 px-3.5 py-2 appearance-none">
                            <option value="">-</option>
                            @foreach($authors as $author)
                                <option
                                    @selected(request()->get('user_id') == $author->id)
                                    value="{{ $author->id }}"
                                    class="flex-1 whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-base font-medium text-gray-900"
                                >{{ $author->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative flex items-center">
                        <label class="absolute text-sm text-gray-400 -top-7">Категория</label>
                        <select name="category" class="cursor-pointer text-gray-800 rounded-md border-0 bg-gray-100 px-3.5 py-2 appearance-none">
                            <option value="">-</option>
                            @foreach($categories as $category)
                                <option
                                    @selected(request()->get('category') == $category->name)
                                    value="{{ $category->name }}"
                                    class="flex-1 whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-base font-medium text-gray-900"
                                >{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-input name="title" value="{{ request()->get('title') }}" placeholder="Название" class="min-w-64 text-gray-800 flex-auto rounded-md border-0 bg-gray-100 px-3.5 py-2 shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm/6"/>
                    <button type="submit"
                            class="flex-none rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Поиск
                    </button>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @foreach($posts as $post)
                    <a href="{{ route('post.show', $post->id) }}" class="group flex flex-col items-start">
                        <img src="{{ $post->imagePath }}"
                             alt="Картинка"
                             class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
                        <h3 class="mt-4 text-sm text-gray-700">{{ $post->title }}</h3>
                        <p class="mt-3 text-white py-1 px-4 bg-indigo-500 rounded">Категория: {{ $post->category->name }}</p>
                        <p class="mt-3 text-white py-1 px-4 bg-indigo-500 rounded">Анонс: {{ \Carbon\Carbon::parse($post->anons)->format('d-m-Y') }}</p>
                        <p class="mt-3 text-white py-1 px-4 bg-indigo-500 rounded">{{ \Carbon\Carbon::parse($post->category->created_at)->format('d-m-Y') }}</p>
                    </a>
                @endforeach
            </div>
            @if(\Illuminate\Support\Facades\Route::currentRouteName() === 'post.index')
                <div class="flex gap-4 justify-center mt-8 ">
                    @for($i = 1; $i <= $lastPage; $i++)
                        <a href="{{ route('post.index') }}?page={{ $i }}" class="flex items-center justify-center size-[30px] rounded cursor-pointer @if($i === $currentPage) bg-indigo-500 text-white @else bg-gray-300 text-gray-800 @endif">{{ $i }}</a>
                    @endfor
                </div>
            @endif
        </form>
    </div>
@endsection
