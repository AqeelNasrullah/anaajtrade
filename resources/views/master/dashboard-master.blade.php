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
        <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard-master.min.css') }}">
        @yield('style')
    </head>

    <body>
        <main class="page">
            <header class="header">
                <section class="container-fluid header-inner py-3 d-none d-lg-block">
                    <div class="container">
                        <div class="logo">
                            <a href="{{ route('dashboard.index') }}">
                                <img src="{{ asset('images/logo.png') }}" width="100%" alt="Logo not found">
                            </a>
                        </div>
                        <div class="logo-txt">
                            <h1 class="text-urdu-kasheeda text-light fw-900">اناج تجارت کا نظام</h1>
                        </div>
                        <br class="clear">
                    </div>
                </section>
                <nav class="navbar navbar-expand-lg navbar-dark bg-success" style="border-bottom: 3px solid goldenrod;">
                    <div class="container">
                        <a class="navbar-brand d-md-block d-lg-none" href="#"><span class="text-urdu-kasheeda fw-700" style="font-size: large;">اناج تجارت کا نظام</span></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrimary">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarPrimary">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link btn btn-success mr-1" href="{{ route('dashboard.index') }}"><i class="fas fa-home"></i> Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link btn btn-success mr-1 dropdown-toggle" href="#" data-toggle="dropdown">
                                        <i class="fas fa-address-book"></i> Roznamcha / <span class="text-urdu-kasheeda">روزنامچہ</span> <i class="fas fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <a href="" class="dropdown-item">Account Book / <span class="text-urdu-kasheeda">کھاتہ</span></a>
                                        <a href="" class="dropdown-item">Oil / <span class="text-urdu-kasheeda">تیل</span></a>
                                        <a href="" class="dropdown-item">Fertilizer / <span class="text-urdu-kasheeda">کھاد</span></a>
                                        <a href="" class="dropdown-item">Agricultural Medicine / <span class="text-urdu-kasheeda">زرعی ادویات</span></a>
                                        <a href="" class="dropdown-item">Wheat / <span class="text-urdu-kasheeda">گندم</span></a>
                                        <a href="" class="dropdown-item">Rice / <span class="text-urdu-kasheeda">چاول</span></a>
                                        <a href="" class="dropdown-item">Others / <span class="text-urdu-kasheeda">دیگر اشیاء</span></a>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link btn btn-success mr-1 dropdown-toggle" href="#" data-toggle="dropdown">
                                        <i class="fas fa-database"></i> Stock / <span class="text-urdu-kasheeda">اسٹاک</span> <i class="fas fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Fertilizer / <span class="text-urdu-kasheeda">کھاد</span></a>
                                        <a class="dropdown-item" href="#">Agricultural Medicine / <span class="text-urdu-kasheeda">زرعی ادویات</span></a>
                                        <a class="dropdown-item" href="#">Wheat / <span class="text-urdu-kasheeda">گندم</span></a>
                                        <a class="dropdown-item" href="#">Rice / <span class="text-urdu-kasheeda">چاول</span></a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link btn btn-success mr-1"><i class="fas fa-dollar-sign"></i> Prices / <span class="text-urdu-kasheeda">قیمتیں</span></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="" class="nav-link btn btn-success dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-plus"></i> More / <span class="text-urdu-kasheeda">مزید</span> <i class="fas fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <a href="{{ route('profile.index') }}" class="dropdown-item"><i class="fas fa-users"></i> Customers / <span class="text-urdu-kasheeda">خریدار</span></a>
                                        <a href="" class="dropdown-item"><i class="fas fa-gas-pump"></i> Filling Stations / <span class="text-urdu-kasheeda">پیٹرول پمپ</span></a>
                                        <a href="" class="dropdown-item"><i class="fas fa-layer-group"></i> Fertilizer Traders / <span class="text-urdu-kasheeda">کھاد کے تاجر</span></a>
                                        <a href="" class="dropdown-item"><i class="fas fa-file-prescription"></i> Medicine Traders / <span class="text-urdu-kasheeda">ادویات کے تاجر</span></a>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link btn btn-success dropdown-toggle px-3" href="#" data-toggle="dropdown">
                                        <div style="width: 30px;height: 30px;float: left;margin-right: 5px;border-radius: 100%;overflow: hidden;">
                                            <img src="{{ Auth::check() ? asset('images/dps/' . auth()->user()->profile->avatar) : asset('images/dps/avatar.jpg') }}" width="100%" alt="Image not found">
                                        </div>
                                        <p style="float: left;margin-top: 2px;" class="mb-0">{{ auth()->user()->profile->name ?? 'Unknown User' }} <i class="fas fa-angle-down"></i></p>
                                        <br class="clear">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-user-tie"></i> Profile</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-unlock"></i> Change Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('login.logout') }}"><i class="fas fa-power-off"></i> Logout</a>
                                    </div>
                                </li>
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
        <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                var height = $('.header').outerHeight() + $('.footer').outerHeight();
                $('.content').css('min-height', 'calc(100vh - ' + height + 'px)');
            });
        </script>
        @yield('script')
    </body>
</html>
