<header class="relative z-50">
    <nav class="flex items-center justify-between p-6 lg:px-6" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="{{ route('home.index') }}" class="-m-1.5 p-1.5">
                <span class="text-lg font-semibold text-gray-900">ABC</span>
            </a>
        </div>
        <div class="flex gap-x-4">
            <a href="{{ route('post.index') }}" class="text-sm/6 font-semibold text-gray-900">Статьи</a>
            @auth
                <a href="{{ route('auth.profile') }}" class="text-sm/6 font-semibold text-gray-900">Профиль</a>
            @endauth
        </div>
        <div class="flex lg:flex-1 lg:justify-end">
            @guest
                @isset($page)
                    @if($page === 'login')
                        <a href="{{ route('auth.registerView') }}" class="text-sm/6 font-semibold text-gray-900">Создать <span aria-hidden="true">&rarr;</span></a>
                    @elseif($page === 'register')
                        <a href="{{ route('auth.loginView') }}" class="text-sm/6 font-semibold text-gray-900">Войти <span aria-hidden="true">&rarr;</span></a>
                    @else
                        <a href="{{ route('auth.loginView') }}" class="text-sm/6 font-semibold text-gray-900">Войти <span aria-hidden="true">&rarr;</span></a>
                    @endif
                @endisset
            @endguest
            @auth
                <x-logout name="Выйти" action="{{ route('auth.logout') }}" class="text-sm/6 font-semibold text-gray-900">Выйти</x-logout>
            @endauth
        </div>
    </nav>
</header>
