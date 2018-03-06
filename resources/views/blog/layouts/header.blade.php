<!DOCTYPE html>
<html {{-- dir="{{ LaravelLocalization::getCurrentLocaleDirection() }} --}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap-'.LaravelLocalization::getCurrentLocaleDirection().'.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="{{ asset('css/fontastic.css') }}">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <!-- Fancybox-->
    <link rel="stylesheet" href="{{ asset('vendor/@fancyapps/fancybox/jquery.fancybox.min.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('css/style.sea.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    @stack('head')
</head>
<body>
    <a href="#" id="scroll" style="display: none;"><span></span></a>
    <header class="header">
        <!-- Main Navbar-->
        <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
            <div class="search-area">
                <div class="search-area-inner d-flex align-items-center justify-content-center">
                    <div class="close-btn"><i class="icon-close"></i></div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <form action="#">
                                <div class="form-group">
                                    <input type="search" name="search" id="search" placeholder="What are you looking for?">
                                    <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <!-- Navbar Brand -->
                <div class="navbar-header d-flex align-items-center justify-content-between">
                    <!-- Navbar Brand --><a href="{{ url('home') }}" class="navbar-brand">Mustafa Blog</a>
                    <!-- Toggle Button-->
                    <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false"
                        aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
                </div>
                <!-- Navbar Menu -->
                <div id="navbarcollapse" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="{{ url('home') }}" class="nav-link active ">@lang('navbar.home')</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('post.index') }}" class="nav-link ">@lang('navbar.blog')</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('post.show', 'aut-dolores-labore-suscipit-beatae-id') }}" class="nav-link ">@lang('navbar.post')</a>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link ">@lang('navbar.contact')</a>
                        </li>
                            <!-- Authentication Links -->
                            @guest
                                <li><a class="nav-link" href="{{ route('login') }}">@lang('navbar.login')</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">@lang('navbar.register')</a></li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->firstname }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                    </ul>
                    <div class="navbar-text"><a href="#" class="search-btn"><i class="icon-search-1"></i></a></div>
                    <ul class="langs navbar-text">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="@if(LaravelLocalization::setLocale() == $localeCode) {{'active'}} @endif">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </header>