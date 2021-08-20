@extends('layouts.master')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Show {{  $book->class }} Book</h1>
    <a href="{{ route('admin.books.list') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    {{-- <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.books.update', $book) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="" class="d-block">Cover</label>
                    <img src="{{ $book->cover }}" alt="" style="width:300px; height:400px;object-fit:cover;" class="rounded">
                </div>
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $book->title }}">
                </div>
                <div class="form-group">
                    <label for="">Category</label>
                    <input type="text" class="form-control" value="{{ $book->category }}" name="category">
                </div>
                <div class="form-group">
                    <label for="">Language</label>
                    <input type="text" class="form-control" value="{{ $book->language }}" name="language">
                </div>
                <div class="form-group">
                    <label for="">Lead Character</label>
                    <input type="text" class="form-control" value="{{ $book->lead_character }}" name="lead_character">
                </div>
                <div class="form-group">
                    <label for="">Lead College</label>
                    <input type="text" class="form-control" value="{{ $book->lead_college }}" name="lead_college">
                </div>
                <div class="form-group">
                    <label for="">Blurb</label>
                    <textarea name="blurb">{{ $book->blurb }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Cost</label>
                    <input type="number" class="form-control" value="{{ $book->cost }}" ame="cost">
                </div>
                <div class="form-group">
                    <label for="">Review Question 1</label>
                    <input type="text" class="form-control" value="{{ $book->review_question_1 }}" name="review_question_1">
                </div>
                <div class="form-group">
                    <label for="">Review Question 2</label>
                    <input type="text" class="form-control" value="{{ $book->review_question_2 }}" name="review_question_2">
                </div>
                <div class="form-group">
                    <label for="">Credit</label>
                    <textarea name="credit_page">{{ $book->credit_page }}</textarea>
                </div>
                <div class="form-group card card-body">
                    <label for="" class="text-lg">
                        list all the details you have changed.
                    </label>
                    <textarea name="changed" class="form-control" required> </textarea>
                </div>
                <button class="btn btn-block btn-primary">SUBMIT</button>
            </form>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header">
            Book details
        </div>
        <div class="card-body row">
            <div class="col-md-3">
                <img src="{{ $book->cover }}" alt="" style="width:300px; height:400px;object-fit:cover;">
            </div>
            <div class="col-md-9">
                <table class="table">
                    <tr>
                        <th>
                            title
                        </th>
                        <td>
                            {{ $book->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Category
                        </th>
                        <td>
                            {{ $book->category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Language
                        </th>
                        <td>
                            {{ $book->language }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Lead Character
                        </th>
                        <td>
                            {{ $book->lead_character }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Lead College
                        </th>
                        <td>
                            {{ $book->lead_college }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Review Question 1
                        </th>
                        <td>
                            {{ $book->review_question_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Review Question 2
                        </th>
                        <td>
                            {{ $book->review_question_2 }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection


@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor\datepicker\DateTimePicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection
@section('bottom')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}" defer></script>
    <script src="{{ asset('vendor\datepicker\DateTimePicker.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}" defer></script>
    <script>
        $(function(){
            $('#dbox').DateTimePicker();
            $.fn.select2.defaults.set( "theme", "bootstrap" );
            $('select').select2();
            $('#tag').select2({
                tags:true,
                tokenSeparators: [',', ' ']
            });

            $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            //rich editor
            CKEDITOR.replace('blurb');
            CKEDITOR.replace('credit_page');
        })
    </script>
@endsection