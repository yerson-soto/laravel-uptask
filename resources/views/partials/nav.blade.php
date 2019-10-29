<nav>
    <a href="#">
        {{ config('app.name', 'Uptask') }} | {{ (auth()->user()) ? auth()->user()->name : '' }}
    </a>

    <ul>
        <li>
            <a href="{{ route('home') }}">@lang('Home')</a>
        </li>
        @auth
            <li>
                <a href="{{ route('projects.index') }}">@lang('Panel')</a>
            </li>
            <li>
                <a href="#"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit()
                ">
                    @lang('Logout')
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                    @csrf
                </form>
            </li>
        @else
            @switch(request()->path())
                @case('register')
                    <li>
                        <a href="{{ route('login') }}">@lang('Login')</a>
                    </li>
                    @break
                @case('login')
                    <li>
                        <a href="{{ route('register') }}">@lang('Register')</a>
                    </li>
                    @break
                @default
                    <li>
                        <a href="{{ route('login') }}">@lang('Login')</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">@lang('Register')</a>
                    </li>
            @endswitch


        @endauth
    </ul>
</nav>
