<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/froala_editor.pkgd.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/froala_style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/myStyle.css') }}" rel="stylesheet" />
    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>My Blog</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/froala_editor.pkgd.min.js') }}" defer></script>
    <!-- <script src="{{ asset('js/plugins/code_beautifier.min.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    My Blog
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li>
                            <form action="{{ action('HomeController@changeLocale') }}" class="form-inline navbar-select" method="POST">
                                <div class="form-group @if($errors->first('locale')) has-error @endif">
                                    <i class="fa fa-globe fa-2x"></i>
                                    <select name="locale" id="language" class="form-control" onchange='this.form.submit()'>
                                        @if(App::getLocale() == 'en')
                                            <option value="en" selected>EN</option>
                                            <option value="pt_br">PT_BR</option>
                                        @else
                                            <option value="en">EN</option>
                                            <option value="pt_br" selected>PT_BR</option>
                                        @endif
                                    </select>
                                    <small class="text-danger">{{ $errors->first('locale') }}</small>
                                </div>

                                <div class="btn-group pull-right sr-only">
                                </div>
                                @csrf
                            </form>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}" title="@lang('messages.login')">@lang('messages.login') <i class="fa fa-sign-in"></i></a></li>
                            <li><a class="nav-link" href="{{ route('register') }}" title="@lang('messages.register')"><i class="fa fa-user-plus"></i></a></li>
                        @else
                            <li>
                                <a class="nav-link" href="{{ action('UsersController@profile', [Auth::user()->id]) }}">
                                    {{ Auth::user()->first_name }}
                                </a>
                            </li>
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"> @lang('messages.logout') <i class="fa fa-sign-out"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            <li class="nav-item">
                                
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div class="footer">
        <div class="container">
            <span class="">@lang('messages.developed')</span>
            <div class="social_media">
                <a href="http://instagram.com/bertonnipaz" target="_blank" title="Instagram"><i class="fa fa-instagram fa-2x social_icons"></i></a>
                <a href="http://github.com/bertonnipaz" target="_blank" title="Github"><i class="fa fa-github fa-2x social_icons"></i></a>
                <a href="http://facebook.com/bertonnipaz" target="_blank" title="Facebook"><i class="fa fa-facebook fa-2x social_icons"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
