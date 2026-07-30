@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.editorialPolicy.index') }}">Editorial & Publishing Policies</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-2 p-3 bg-white rounded">
        <form action="{{ route('admin.setting.editorialPolicy.index') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="editorial_policy_info" class="form-label"><strong>Editorial & Publishing Policies Details</strong></label>
                    <textarea name="editorial_policy_info" id="editorial_policy_info" class="form-control note">{!! $editorialPolicy->data ?? '' !!}</textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-sm">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
