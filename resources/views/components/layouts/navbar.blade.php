<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">{{ __('Articles') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif

                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <vue-notepad url="{{ route('notepad.index') }}">
                            <template v-slot:notepad_slot="{ onShow }">
                                    <a class="nav-link" href="#" @click.prevent="onShow">
                                        <i class="fa-regular fa-note-sticky fa-fw pr-1 pr-md-0" title="{{ __('Notepad') }}"></i>
                                        <span class="d-md-none">{{ __('Notepad') }}</span>
                                    </a>
                            </template>
                        </vue-notepad>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-regular fa-user fa-fw pr-1 pr-md-0" title="{{ Auth::user()->name }}"></i>
                            <span class="d-md-none">{{ Auth::user()->name }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @can('viewAny', \App\Models\Guestbook::class)
                                <a class="dropdown-item" href="{{ route('guestbook.index') }}">{{ __('Guestbook') }}</a>
                            @endcan
                            <a class="dropdown-item" href="{{ route('articles.user') }}">{{ __('My articles') }}</a>
                            <a class="dropdown-item" href="{{ route('shoppinglists.index') }}">{{ __('My shopping lists') }}</a>
                            @can('viewAny', \App\Models\Invitation::class)
                                <a class="dropdown-item" href="{{ route('invitations.index') }}">{{ __('My invitations') }}</a>
                            @endcan
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
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