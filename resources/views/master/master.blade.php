<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#40A517">
        @yield('title')
        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('images/thumb.png') }}" type="image/x-icon">
        {{-- Google Fonts --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,700,700i,900,900i&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i&display=swap">
        {{-- Stylesheets --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootnavbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/master.min.css') }}">
        @yield('style')
    </head>

    <body>
        <section class="preloader d-flex justify-content-center align-items-center">
            <div class="preloader-circle"></div>
            <div class="preloader-img">
                <img src="{{ asset('images/thumb.png') }}" width="100%" alt="image not found">
            </div>
        </section>
        <main class="main">
            <header class="header">
                <nav class="navbar navbar-expand-lg navbar-dark bg-success" id="navbar">
                    <div class="container">
                        <a class="navbar-brand text-light" href="{{ url('') }}" style="font-size: x-large !important;"><span class="text-urdu-kasheeda">اناج تجارت کا نظام</span></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrimary">
                            <span class="navbar-toggler-icon text-light" style="height: inherit !important;"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarPrimary">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ url('') }}"><i class="fas fa-home"></i> Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ url('help') }}"><i class="fas fa-question-circle"></i> Help Center</a>
                                </li>
                                <li class="nav-item seperator">
                                    <a class="nav-link text-light">|</a>
                                </li>
                                @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light" href="#" data-toggle="dropdown">
                                        <i class="fas fa-user-tie"></i> {{ auth()->user()->profile->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('dashboard.index') }}"><i class="fas fa-home"></i> Dashboard</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-user-tie"></i> Profile</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-unlock"></i> Change Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('login.logout') }}"><i class="fas fa-power-off"></i> Logout</a>
                                    </div>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login.index') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                                </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <main class="content">
                @yield('content')
            </main>

            <footer class="footer">
                <p class="mb-0 text-light text-center">Copyrights &copy; {{ date('Y') }} - All Rights Reserved by Department of Computer Science, RCET Gujranwala</p>
            </footer>
        </main>

        {{-- Script Files --}}
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/fontawesome.min.js') }}"></script>
        <script src="{{ asset('js/bootnavbar.js') }}"></script>
        <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                var height = $('.header').outerHeight() + $('.footer').outerHeight();
                $('.content').css('min-height', 'calc(100vh - ' + height + 'px)');

                $('#navbar').bootnavbar();

                $(window).on('load', function () {
                    $('.preloader').fadeOut('slow', function () {
                        $(this).remove();
                    });
                });
            });
        </script>
        @yield('script')
    </body>
</html>
