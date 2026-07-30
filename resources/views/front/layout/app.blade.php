<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @php
        $general = getGeneralLayout();
    @endphp
    <title>{{ config('app.name') }} @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset($general->fav) }}">
    @yield('meta')
    @if (!View::hasSection('meta'))
        @includeIf('front.cache.meta')
    @endif
    <link rel="stylesheet" href="{{ asset('asset/front/css/index.css') }}?v=1">

    @yield('style')

</head>

<body>
    <div class="content">
        <div class="topbar">
            <div class="left">
                {{ $general->content }}
            </div>
            <div class="d-block d-md-none center">
                <hr class="my-1">
            </div>
            <div class="logins">
                <div class="login-area">
                    <div class="register">
                        <a href="{{ route('client.submission.add') }}">Make a Submission</a>
                    </div>
                    <span>
                        @auth
                            <div class="login">
                                <a href="{{ route('client.index') }}">Dashboard</a>
                            </div>
                        @endauth
                        @guest
                            <div class="login">
                                <a href="{{ route('front.login') }}">Login</a>
                            </div>
                            <div class="register">
                                <a href="{{ route('register') }}">Register</a>
                            </div>
                        @endauth
                    </span>
                </div>
            </div>
        </div>
        <hr class="m-0">
        <header>
            <nav class="navbar navbar-expand-lg ">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ vasset($general->logo) }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item" id="item">
                            <a class="nav-link" href="{{ route('index') }}" id="item_a">HOME</a>
                        </li>
                        <li class="nav-item" id="item">
                            <a class="nav-link" href="{{ route('about') }}" id="item_a">ABOUT
                                US</a>
                        </li>
                        <li class="nav-item" id="item">
                            <a class="nav-link" href="{{ route('editorial_publishing_policy') }}" id="item_a">EDITORIAL &amp; PUBLISHING POLICIES</a>
                        </li>
                        {{-- <li class="nav-item" id="item">
                            <a class="nav-link" href="{{ route('policy') }}"
                                id="item_a">
                                POLICY</a>
                        </li> --}}
                        <li class="nav-item" id="item">
                            <a class="nav-link" href="{{ route('submission') }}" id="item_a">SUBMISSION
                                GUIDELINES</a>
                        </li>
                        <li class="nav-item" id="item">
                            <a class="nav-link" href="{{ route('team') }}"> EDITORIAL TEAM</a>
                        </li>

                        <li class="nav-item" id="item">
                            <a class="nav-link" href="{{ route('archive') }}" id="item_a">ARCHIVE</a>
                        </li>
                        <li class="nav-item" id="item">
                            <a class="nav-link" href="{{ route('contact') }}" id="item_a">CONTACT US</a>
                        </li>
                        @includeIf('front.cache.more')
                    </ul>
                </div>


            </nav>
            {{-- <div class="navigation">
                <div class="left">
                    <div class="logo">
                        <a href="{{ route('index') }}">
                            <img src="{{ vasset($general->logo) }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="right">
                    <div class="headers  d-flex justify-content-end">
                    </div>
                </div>
            </div> --}}
        </header>
        @if (View::hasSection('hideInnerBanner'))
            @yield('hideInnerBanner')
        @else
            <div class="inner-banner">
                <h1>
                    @yield('top_name')
                </h1>
                <div class="header-link">
                    <a href="{{ route('index') }}">Home</a>
                    <i class="fa-solid fa-circle"></i>
                    @yield('header_link')
                </div>

            </div>
        @endif
        <div class="main-container" style="border-top:1px solid #DDDDDD ;border-bottom:1px solid #DDDDDD;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="padding: 30px 20px">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="associates-section py-3"
            style="background-color: #9ee5d9; border-top: 1px solid #cce8e3; border-bottom: 1px solid #cce8e3;">
            <div class="container">
                @includeif('front.cache.sidebar')
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
                                        <a href="{{ route('about') }}">ReadMore</a>
                                    </p>
                                </div>
                                {{-- <div class="social-icons">
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
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="getintouch">
                                <div class="head pb-2">
                                    <h5>Get In Touch</h5>
                                </div>
                                @includeif('front.cache.contact_footer')
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
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
                        </div> --}}
                    </div>
                </div>
                <div class="copyright">
                    <p class="sj-copyrights">©{{ date('Y') }}, <a href="#">
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
