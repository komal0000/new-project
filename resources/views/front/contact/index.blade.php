@extends('front.layout.app')
@section('header_link')
<a href="#">Contact Us</a>
@endsection
@section('top_name')
Contact Us
@endsection
@section('content')
    @includeif('front.cache.contact')
@endsection

