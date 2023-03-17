<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            <a class="navbar-brand" @if(!Auth::user()) href="http://www.juni-devs.php-f22.ru" @endif  @if(Auth::user()) href="{{ url('/') }} @endif">
                JUNI-DEVS
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->

                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                    @else
                        <li class="nav-item d-flex me-2">
                            <a class="nav-link " aria-current="page" href="{{route('home')}}">PHR-Converter</a>
{{--                        RECORDS--}}
                        @if(auth()->user()->can('read records'))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Records
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" aria-current="page" href="{{route('airlines.index')}}">Airlines</a>
                                <a class="dropdown-item" aria-current="page" href="{{route('airports.index')}}">Airports</a>
                                <a class="dropdown-item" aria-current="page" href="{{route('countries.index')}}">Countries</a>
                                <a class="dropdown-item" aria-current="page" href="{{route('states.index')}}">States</a>
                                <a class="dropdown-item" aria-current="page" href="{{route('services.index')}}">Service codes</a>
                            </div>

                        </li>
                        @endif
{{--SYSTEM--}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                System
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->can('create user'))
                                <a class="dropdown-item" href="{{ route('register') }}">Create User</a>
                                @endif
                                @if(auth()->user()->can('read roles'))
                                <a class="dropdown-item" aria-current="page" href="{{route('roles.index')}}">Roles</a>@endif
                                    @if(auth()->user()->can('read perms'))
                                <a class="dropdown-item" aria-current="page" href="{{route('perms.index')}}">Permissions</a>
                                    @endif
                            </div>
                        </li>

                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>   {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

</div>
