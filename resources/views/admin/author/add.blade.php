@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.author.index') }}">Authors</a>
    <a href="{{ route('admin.author.add') }}">Add</a>
@endsection
@section('active', 'author')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{ route('admin.author.add') }}" method="POST">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-4 mb-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" class="form-control" required>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="designation">Designation</label>
                    <input type="text" name="designation" id="designation" class="form-control" required>
                </div>
                <div class="col-md-8 mb-2">
                    <label for="organization">Organization</label>
                    <input type="text" name="organization" id="organization" class="form-control" required>
                </div>
                <div class="col-md-4 mb-2 text-start d-flex align-items-end p-1">
                    <button class="btn btn-primary btn-sm">
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
@endsection
