<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    {{-- <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all"> --}}

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">
    {{-- Fontawesome link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">

            <div class="logo">
                <a href="#">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>

            <div class="menu-sidebar__content js-scrollbar1">

                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a href="{{route('admin#dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a href="{{ route('category#list') }}">
                                <i class="fa-solid fa-list-ul"></i>Category
                            </a>
                        </li>

                        <li class="active has-sub">
                            <a href="{{ route('product#list') }}">
                                <i class="fa-solid fa-pizza-slice"></i>Product
                            </a>
                        </li>

                        <li class="active has-sub">
                            <a href="{{ route('admin#orderList') }}">
                                <i class="fa-solid fa-clipboard-list"></i>Orders
                            </a>
                        </li>

                        <li class="active has-sub">
                            <a href="{{ route('admin#userList') }}">
                                <i class="fa-solid fa-users"></i>Users
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a href="{{route('admin#receiveMail')}}">
                                <i class="fa-solid fa-comment-dots"></i>User_Mails
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="header-wrap">
                            <h3>Admin Pannel</h3>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/male.jpg') }}"
                                                        class="shadow-sm img-thumbnail"
                                                        style="width:45px; height:45px; border-radius: 50%">
                                                @else
                                                    <img src="{{ asset('image/female.png') }}"
                                                        class="shadow-sm img-thumbnail"
                                                        style="width:45px; height:45px; border-radius: 50%">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    class="shadow-sm img-thumbnail"
                                                    style="width:45px; height:45px; border-radius: 50%">
                                            @endif
                                        </div>

                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                        </div>

                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    @if (Auth::user()->image == null)
                                                        @if (Auth::user()->gender == 'male')
                                                            <img src="{{ asset('image/male.jpg') }}"
                                                                class="shadow-sm img-thumbnail"
                                                                style="width:45px; height:45px; border-radius: 50%">
                                                        @else
                                                            <img src="{{ asset('image/female.png') }}"
                                                                class="shadow-sm img-thumbnail"
                                                                style="width:45px; height:45px; border-radius: 50%">
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                            class="shadow-sm img-thumbnail"
                                                            style="width:45px; height:45px; border-radius: 50%">
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__body">

                                                <div class="account-dropdown__item">

                                                    <a href="{{ route('admin#profile') }}">
                                                        <i class="fa-solid fa-user"></i>Profile
                                                    </a>

                                                </div>
                                            </div>

                                            <div class="account-dropdown__body">

                                                <div class="account-dropdown__item">

                                                    <a href="{{ route('admin#changePassword') }}">
                                                        <i class="fa-solid fa-key"></i>Change Password
                                                    </a>

                                                </div>
                                            </div>

                                            <div class="account-dropdown__body">

                                                <div class="account-dropdown__item">

                                                    <a href="{{ route('admin#list') }}">
                                                        <i class="fa-solid fa-users-between-lines"></i>Admin List
                                                    </a>

                                                </div>
                                            </div>

                                            <div class="account-dropdown__footer my-3">

                                                <form action="{{ route('logout') }}" method="POST"
                                                    class="d-flex justify-content-center">

                                                    @csrf

                                                    <button class="btn bg-dark text-white col-10" type="submit">
                                                        <i class="fa-solid fa-power-off"></i>Logout
                                                    </button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            @yield('content')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

        <!-- Jquery JS-->
        <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
        <!-- Bootstrap JS-->
        <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
        <!-- Vendor JS       -->
        <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

        <!-- Main JS-->
        <script src="{{ asset('admin/js/main.js') }}"></script>
        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    @yield('scriptSource')
    </html>
<!-- end document-->
