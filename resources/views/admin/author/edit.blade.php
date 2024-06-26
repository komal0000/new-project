@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.author.index') }}">Authors</a>
    <a href="{{ route('admin.author.edit',['author_id'=>$author->id]) }}">Edit</a>
@endsection
@section('active', 'author')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{ route('admin.author.edit',['author_id'=>$author->id]) }}" method="POST">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-6 mb-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{$author->name}}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" value="{{$author->link}}" class="form-control" >
                </div>
                <div class="col-md-12 mb-2">
                    <label for="designation">Designation</label>
                    <input type="text" name="designation" id="designation" value="{{$author->designation}}" class="form-control" >
                </div>
                <div class="col-md-12 mb-2">
                    <label for="organization">Organization</label>
                    <input type="text" name="organization" id="organization" value="{{$author->organization}}" class="form-control" >
                </div>
               <div class="col-md-4 mb-2 text-start d-flex align-items-end p-1">
                    <button class="btn btn-primary btn-sm">
                        update
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
@endsection
