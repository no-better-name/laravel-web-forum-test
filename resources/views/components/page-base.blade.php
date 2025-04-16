<html lang="en">
    <head>
        <meta charset="utf-8"/>
        @if(!empty($description))
        <meta name="description" content="{{ $description }}">
        @endif
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>
        {{ $title  }}
        </title>

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
        <link rel="shortcut icon" href="{{ asset('img/C_Programming_Language.svg') }}" type="image/svg">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="d-flex flex-column min-vh-100">
        <x-page-common.header>
        </x-page-common.header>
        <x-page-common.nav-bar>
        </x-page-common.nav-bar>
        <x-page-common.main-part>
            @if(session()->get('user-messages'))
                @foreach(config('app.user_errors') as $err)
                    @if(session()->has($err))
                        <div class="alert alert-primary" data-bs-theme="dark" role="alert">
                            {{ session()->get($err) }}
                        </div>
                    @endif
                @endforeach
            @endif
            {{ $slot }}
        </x-page-common.main-part>
        <x-page-common.footer>
        </x-page-common.footer>
    </body>
</html>
