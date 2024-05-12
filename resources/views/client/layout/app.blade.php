<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/back/plugins/drophify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/client/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <div class="navigation">
        <div class="left">
            <div class="name">
                <a href="">
                    Name
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
                username
            </div>
        </div>

    </div>
    <div class="row m-0">
        <div class="col-md-2 p-0">
            @include('client.sidebar')
        </div>
        <div class="col-md-10 p-0">
            <div class="top" style="background-color: #DDDDDD">
                <h1 class="link">
                    <a href="{{ route('client.index') }}">Dashboard</a>
                    @yield('header-link')
                </h1>

                @yield('toolbar')
            </div>
            <div class="p-2">
                @yield('content')
            </div>
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
    @yield('js')
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
