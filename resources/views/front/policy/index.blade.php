@extends('front.layout.app')
@section('header_link')
    <a href="{{route('policy')}}">Policy</a>
@endsection
@section('content')
    <div class="container">
        <h1 class="page_title" style="font-size: 24px; font-weight: 700; padding: 30px 0px" >
            Policy
        </h1>
        @include('front.cache.policy')
    </div>
@endsection
