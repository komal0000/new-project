@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.generalLayout.general_index') }}">General Layout</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-2 p-3 rounded">
        <form action="{{ route('admin.setting.generalLayout.general_index') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label for="copy_right_name">Copy Right Name</label>
                    @if ($generalLayout == null)
                        <input type="text" name="copy_right_name" id="copy_right_name" class="form-control">
                    @else
                        <input type="text" name="copy_right_name" id="copy_right_name"
                            value="{{ $generalLayout->copy_right_name }}" class="form-control">
                    @endif
                </div>

                <div class="col-md-3 mb-2">
                    <label for="copy_right_date">Copy Right Date</label>
                    @if ($generalLayout == null)
                        <input type="date" name="copy_right_date" id="copy_right_date" class="form-control">
                    @else
                        <input type="date" name="copy_right_date" id="copy_right_date" class="form-control"
                            value="{{ $generalLayout->copy_right_date }}">
                    @endif
                </div>
                <div class="col-md-6 mb-2">
                    <label for="short_desc">Short Description Of Logo</label>
                    @if ($generalLayout == null)
                        <input type="text" name="short_desc" id="short_desc" class="form-control">
                    @else
                        <input type="text" name="short_desc" id="short_desc" class="form-control"
                            value="{{ $generalLayout->short_desc }}">
                    @endif
                </div>
                <div class="col-md-12 mb-2">
                    <label for="long_desc">Long Description Of Logo</label>
                    @if ($generalLayout == null)
                        <textarea name="long_desc" id="long_desc" class="form-control"></textarea>
                    @else
                        <textarea name="long_desc" id="long_desc" class="form-control"> {{ $generalLayout->long_desc }} </textarea>
                    @endif
                </div>

                <div class="col-md-4 mb-2">
                    <label for="logo">Logo</label>
                    @if ($generalLayout == null)
                        <input type="file" name="logo" id="logo" accept="image/*" class="form-control photo">
                    @else
                        <input type="file" name="logo" id="logo" accept="image/*" class="form-control photo"
                            data-default-file="{{ vasset($generalLayout->logo) }}">
                    @endif
                </div>

                <div class="col-md-12 text-start">
                    <button class="btn btn-primary btn-sm">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection