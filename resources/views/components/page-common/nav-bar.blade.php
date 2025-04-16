<nav class="navbar navbar-expand-lg sticky-top forum-navbar" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url("/") }}">C Amateurs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="container-fluid justify-content-between navbar-nav me-auto mb-lg-0">
                <li class="nav-item dropdown my-1">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Most recent
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('post.list') }}">Posts</a></li>
                        <li><a class="dropdown-item" href="{{ route('comment.list') }}">Comments</a></li>
                    </ul>
                </li>
                <li class="nav-item my-1">
                    <form class="d-flex me-2 my-0" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </li>

                <li class="nav-item">
                    @guest
                        <div class="d-flex my-1">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>
                    @else
                        <li class="nav-item dropdown my-1">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.show', ['id' => Auth::user()->id]) }}">Profile</a>

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
                </li>
            </ul>
        </div>
    </div>
</nav>
