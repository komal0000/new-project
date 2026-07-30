@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
@endsection
<style>
    .link{
        font-size: 16px;
    }
    strong{
        font-size: 17px
    }
</style>
@section('active', 'setting')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <div class="row p-2 mb-1">
            <div class="col-md-12 ">
                <strong> General Setting</strong>
                <div class="mt-2" style="display: flex; column-gap: 30px">
                    <a class="link" href="{{ route('admin.setting.policy.policy_index') }}">Policy</a>
                    <a class="link" href="{{ route('admin.setting.about.about_index') }}">About</a>
                    <a class="link" href="{{ route('admin.setting.editorialPolicy.index') }}">Editorial & Publishing Policies</a>
                    <a class="link" href="{{ route('admin.guideline.index')}}">Guidelines</a>
                    <a class="link" href="{{route('admin.setting.associate.index')}}">Associations</a>
                    <a class="link" href="{{route('admin.setting.generalLayout.general_index')}}">General Layout</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row p-2 mb-1">
            <div class="col-md-12">
                <strong>Other setting</strong>
                <div class="mt-2" style="display: flex; column-gap: 30px">
                    <a class="link" href="{{route('admin.setting.contact.index')}}">Contact</a>
                    <a class="link" href="{{route('admin.setting.artical_type.indexArtical')}}">Article Types</a>
                </div>
            </div>
        </div>
    </div>
@endsection
