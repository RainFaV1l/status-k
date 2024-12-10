<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Auth Module - {{ config('app.name', 'ABC') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.svg') }}">

    {{-- Vite CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{--    @vite(\Nwidart\Modules\Module::getAssets())--}}
    {{--     {{ module_vite('build-auth', 'resources/assets/sass/app.scss', storage_path('vite.hot')) }}--}}
</head>

<body>

<x-home::alerts/>

@yield('content')

{{-- Vite JS --}}
{{--     {{ module_vite('build-auth', 'resources/assets/js/app.js', storage_path('vite.hot')) }}--}}
</body>
