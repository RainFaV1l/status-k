@extends('auth::layouts.master')

@section('content')
    <div class="bg-white">
        <x-home::header page="login"/>
        <hr>
        <div class="flex flex-col gap-7 px-6 pt-10">
            <h1 class="text-xl font-bold">Список пользователей</h1>
            <div class="flex items-center justify-start flex-wrap gap-7">
                @foreach($users as $user)
                    <a href="{{ route('chat.show', $user->sender_id) }}" class="py-4 px-8 bg-gray-50 rounded">
                        <h3 class="text-sm font-bold">{{ $user->full_name }}</h3>
                        <p class="text-sm">Сообщений: {{ $user->sender_count }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
