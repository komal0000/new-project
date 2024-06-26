@extends('admin.layout.app')
@section('header-Links')
    <a href="{{route('admin.book.index')}}">Issues</a>
    <a href="#">Add</a>
@endsection
@section('active','book')
@section('content')
 <div class="shadow mt-3 p-3 bg-white rounded">
    <form action="{{route('admin.book.add')}}" id="book" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="mb-2">
                    <label for="image">Cover Image</label>
                    <input type="file" name="image" id="image" class="form-control photo" accept="image/jpeg, image/jpg ,image/png" required>
                </div>
                {{-- <div class="mb-3">
                    <label for="file">PDF File</label>
                    <input type="file" name="file" id="file" class="form-control photo"accept=".pdf" required>
                </div> --}}
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8 mb-2">
                        <label for="title">{{-- Original --}} Title</label>
                        <input type="text" name="title" id="title" class="form-control" {{--onInput="$('#eng_title').val(this.value)" --}} required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="volume">Volume</label>
                        <input type="text" name="volume" id="volume" class="form-control" required >
                    </div>
                    {{-- <div class="col-md-4 mb-2">
                        <label for="eng_title">English Title</label>
                        <input type="text" name="eng_title" id="eng_title" class="form-control" required>
                    </div> --}}
                    <div class="col-md-6 mb-2">
                        <label for="issn">Issn</label>
                        <input type="number" name="issn" id="issn" class="form-control" >
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="doi">DOI</label>
                        <input type="text" name="doi" id="doi" class="form-control" >
                    </div>
                    {{-- <div class="col-md-4 mb-3">
                        <label for="issue_name">Issue</label>
                        <input type="text" name="issue_name" id="issue_name" class="form-control" required >
                    </div> --}}
                    <div class="col-md-3 mb-2">
                        <label for="language_of_publication">Language </label>
                        <input type="text" name="language_of_publication" id="language_of_publication" class="form-control" value="English" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="issue">Issue Date</label>
                        <input type="date" name="issue" id="issue"  class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="published_date">Published Date</label>
                        <input type="date" name="published_date" id="published_date" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-2" style="align-content: center">
                        <input type="checkbox" name="iscurrent" id="iscurrent">
                        <label for="iscurrent" class="ms-2">Iscurrent</label>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="s_description">Short Description</label>
                        <textarea type="text" name="s_description" id="s_description" class="form-control" rows="3"></textarea>
                    </div>
                    {{-- <div class="col-md-12 mb-2">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control" required></textarea>
                    </div> --}}

                    <div class="col-md-12 mb-2 text-end">
                        <a class="btn btn-danger btn-sm" href="{{route('admin.book.index')}}" onclick="return yes();">
                            Cancel
                        </a>
                        <button class="btn btn-primary btn-sm">
                            Save Data
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
 </div>
@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('book').addEventListener('submit', function(event) {
            var isCurrentCheckbox = document.getElementById('iscurrent');
            if (!isCurrentCheckbox.checked) {
                return false;
            }
            return true;
        });
    });
</script>
@endsection
