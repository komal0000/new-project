<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('asset/front/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/css/login/index.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/css/aboutus/index.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/css/articlesingle/index.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/css/contact/index.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/css/register/index.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/css/archive/index.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/css/archive/single/index.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/front/css/team/index.css') }}">
    <title>{{ config('app.name') }} @yield('title')</title>
    <style>

    </style>

    @yield('meta')

</head>

<body>
    @php
        $general = DB::table('generallayouts')->first();
        $teams = DB::table('teams')->get();
    @endphp
    <div class="content">
        <div class="topbar">
            <div class="container" style="padding :10px">
                <div class="left">
                    {{ $general->content }}
                </div>
                <div class="logins">
                    <div class="login-area">
                        <div class="login">
                            <a href="{{ route('front.login') }}">Login</a>
                        </div>
                        <div class="register">
                            <a href="{{ route('register') }}">Register</a>
                        </div>
                    </div>
                    <div class="language">

                    </div>
                </div>
            </div>
            <div class="line px-4">
                <hr class="m-0">
            </div>
        </div>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-12 p-2 col-md-12 p-0">
                        <div class="navigation">
                            <div class="left">
                                <div class="logo">
                                    <a href="{{ route('index') }}">
                                        <img src="{{ vasset($general->logo) }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="right">
                                <div class="headers  d-flex justify-content-end">
                                    <nav class="navbar navbar-expand-lg ">
                                        <div class="container-fluid">
                                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#navbarSupportedContent"
                                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                                aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span>
                                            </button>
                                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                    <li class="nav-item" id="item">
                                                        <a class="nav-link" href="{{ route('index') }}"
                                                            id="item_a">HOME</a>
                                                    </li>
                                                    <li class="nav-item" id="item">
                                                        <a class="nav-link" href="{{ route('about') }}"
                                                            id="item_a">ABOUT
                                                            US</a>
                                                    </li>
                                                    <li class="nav-item" id="item">
                                                        <a class="nav-link" href="{{ route('policy') }}"
                                                            id="item_a">
                                                            POLICY</a>
                                                    </li>
                                                    <li class="nav-item" id="item">
                                                        <a class="nav-link" href="{{ route('contact') }}"
                                                            id="item_a">CONTACT</a>
                                                    </li>
                                                    <li class="nav-item" id="item">
                                                        <a class="nav-link" href="{{ route('submission') }}"
                                                            id="item_a">INSTRUCTION & GUIDELINES</a>
                                                    </li>
                                                    @if ($teams)
                                                        @foreach ($teams as $item)
                                                            <li class="nav-item" id="item">
                                                                <a class="nav-link"
                                                                    href="{{ route('team.member', ['team_id' => $item->id]) }}"
                                                                    id="item_a">{{ strtoupper($item->title) }}</a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                    @endif

                                                    <li class="nav-item" id="item">
                                                        <a class="nav-link" href="{{ route('archiveIssue') }}"
                                                            id="item_a">OLD ISSUE</a>
                                                    </li>
                                                    {{-- <li class="nav-item dropdown" id="dropdown">
                                                        <a class="nav-link dropdown-toggle" href="#"
                                                            id="navbarDropdown" role="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            ISSUE
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <li><a class="dropdown-item" href="#">Current</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="{{route('archiveIssue')}}">Archives</a>
                                                            </li>
                                                        </ul>
                                                    </li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        @if (View::hasSection('hideInnerBanner'))
            @yield('hideInnerBanner')
        @else
            <div class="inner-banner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-12 col-lg-12 ">
                            <h1>
                                @yield('top_name')
                            </h1>
                            <div class="header-link">
                                <a href="{{ route('index') }}">Home</a>
                                <i class="fa-solid fa-circle"></i>
                                @yield('header_link')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="main-container" style="border-top:1px solid #DDDDDD ;border-bottom:1px solid #DDDDDD;">
            <div class="container">
                <div class="row">
                    <div class="col-md-10" style="padding: 30px 20px">
                        @yield('content')
                    </div>
                    <div class="col-md-2 p-0" style="border-left:1px solid #DDDDDD ;">
                        <div class="sidebar">
                            {{-- <div class="heading">
                                <a href="#">Make a Submission</a>
                            </div> --}}
                            @includeif('front.cache.sidebar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="footer-column">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="aboutus">
                                <div class="logo">
                                    <a href="#">
                                        <img src="{{ vasset($general->logo) }}" alt="">
                                    </a>
                                </div>
                                <div class="description mt-1">
                                    <p>
                                        {{ $general->short_desc }}
                                        <a href="#">ReadMore</a>
                                    </p>
                                </div>
                                <div class="social-icons">
                                    <div class="facebook-icon">
                                        <i class="fab fa-facebook-f"></i>
                                    </div>
                                    <div class="twitter-icon">
                                        <i class="fab fa-twitter"></i>
                                    </div>
                                    <div class="linkedin-icon">
                                        <i class="fab fa-linkedin-in"></i>
                                    </div>
                                    <div class="google-icon">
                                        <i class="fab fa-google-plus-g"></i>
                                    </div>
                                    <div class="rss-icon">
                                        <i class="fa fa-rss"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="getintouch">
                                <div class="head">
                                    <h5>Get In Touch</h5>
                                </div>
                                @includeif('front.cache.contact')
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="resource">
                                <div class="head">
                                    <h5>Resource</h5>
                                </div>
                                <div class="item">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                Author
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                librarian
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                sponsers & Advertisers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Press & Media
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <p class="sj-copyrights">© {{ $general->copy_right_date }} <a href="">
                            {{ $general->copy_right_name }}</a>. All Rights Reserved</p>
                </div>

            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('front.layout.jshelper')
    @yield('js')
</body>

</html>
