@extends('post::layouts.master')

@section('content')
    <div class="bg-white">
        <x-home::header page="announcements"/>
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Добавление статьи</h2>
            </div>
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <x-form method="POST" action="{{ route('post.store') }}" :has-files="true" class="space-y-6">
                    <div>
                        <x-label for="Заголовок" class="block text-sm/6 font-medium text-gray-900"/>
                        <div class="mt-2">
                            <x-input
                                name="title"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="title" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <x-label for="Категория" class="block text-sm/6 font-medium text-gray-900"/>
                        <div class="mt-2">
                            <select name="post_category_id" class="cursor-pointer text-gray-800 rounded-md border-0 bg-gray-100 px-3.5 py-2 appearance-none">
                                <option value="">-</option>
                                @foreach($categories as $category)
                                    <option
                                        @selected(old('post_category_id') == $category->name)
                                        value="{{ $category->id }}"
                                        class="flex-1 whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-base font-medium text-gray-900"
                                    >{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error field="post_category_id" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <x-label for="Превью" class="block text-sm/6 font-medium text-gray-900"/>
                        <div class="mt-2">
                            <input type="file"
                                name="image"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="image" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <x-label for="Описание" class="block text-sm/6 font-medium text-gray-900"/>
                        <div class="mt-2">
                            <x-textarea
                                name="description"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="description" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <x-label for="Анонс" class="block text-sm/6 font-medium text-gray-900"/>
                        <div class="mt-2">
                            <input
                                type="date"
                                name="anons"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                            <x-error field="anons" class="text-red-500 mt-2 text-sm" />
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Отправить на модерацию
                        </button>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
