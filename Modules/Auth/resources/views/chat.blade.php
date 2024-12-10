@extends('auth::layouts.master')

@section('content')
    <div class="bg-white">
        <x-home::header page="login"/>
        <hr>
        <div class="flex flex-col gap-7 px-6 pt-10">
            <h1 class="text-xl font-bold">Диалог с пользователем: {{ $friend?->full_name }}</h1>
            @if(isset($user_id) && isset($friend))
                <x-auth::chat :user_id="$user_id" :author_id="$friend->id"/>
            @endif

        </div>
    </div>
@endsection
