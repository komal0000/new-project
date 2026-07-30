@extends('front.layout.app')
@section('header_link')
    <a href="{{ route('editorial_publishing_policy') }}">Editorial & Publishing Policies</a>
@endsection
@section('content')
    <div class="container">
        <h1 class="page_title" style="font-size: 24px; font-weight: 700; padding: 30px 0px">
            Editorial & Publishing Policies
        </h1>
        @include('front.cache.editorial_publishing_policy')
    </div>
@endsection
