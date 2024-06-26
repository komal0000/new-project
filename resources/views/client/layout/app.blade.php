<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('asset/client/index.css') }}">
    @php
        $general = getGeneralLayout();
    @endphp
    <link rel="icon" type="image/x-icon" href="{{asset($general->fav)}}">

</head>

<body>
    @php
        $user = Auth::user();

    @endphp
    {{-- <div class="navigation">
        <div class="left">
            <div class="name">
                <a href="">
                    {{config('app.title')}}
                </a>
            </div>
        </div>
        <div class="right">
            <div class="homepage">
                <a href="{{ route('index') }}">
                    <i class="fa-solid fa-eye"></i>
                    view site
                </a>
            </div>
            <div class="profile">
                <i class="fa-solid fa-user"></i>
                {{ $user->name }}
                <div class="drop-down">
                    <div class="item">
                        <a href="{{ route('client.info.index') }}">My Profile</a>
                    </div>
                    <div class="item">
                        <a href="{{ route('client.info.password') }}">Change Password</a>
                    </div>
                    <div class="item">
                        <a href="{{ route('clientLogout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
    @include('client.sidebar')
    <div class="main">

        <div class="menu d-flex d-md-none">
            <span class="title">
                {{config('app.title')}}
            </span>
            <span class="open" onclick="$('#sidebar').addClass('active')">
                &#8801;
            </span>
        </div>
        <div class="top" style="background-color: #DDDDDD">
            <h1 class="link">
                <a href="{{ route('client.index') }}">Dashboard</a>
                @yield('header-link')
            </h1>
            @yield('toolbar')
        </div>


        <div class="px-4 py-2">
            @yield('content')
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js"
        integrity="sha512-NQfB/bDaB8kaSXF8E77JjhHG5PM6XVRxvHzkZiwl3ddWCEPBa23T76MuWSwAJdMGJnmQqM0VeY9kFszsrBEFrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('asset/back/plugins/drophify/js/dropify.min.js') }}"></script>

    @include('admin.layout.jshelper')
    <script>
        $(document).ready(function() {
            $('.photo').dropify();
            $('.note').summernote({
                tabsize: 2,
                height: 200,
            });
            $('#@yield('active')').addClass('active');
            $('.tool-bar .btn').addClass('btn-sm');
        });
    </script>
    @yield('js')
</body>

</html>
