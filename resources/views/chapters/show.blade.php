@extends('layouts.admin')

@section('main-content')
    <h1>
        View and Edit <span style="text-transform:capitalize"> {{ $chapter->mode }}</span>
    </h1>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Details
                </div>
                <div class="card-body">
                    @if ($book->category != 'Series')
                    <form action="{{ route('books.chapters.update', ['book'=>$book, 'chapter'=>$chapter]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" value="{{ $chapter->title}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Cost</label>
                            <input type="text" class="form-control" value="{{ $chapter->cost}}" disabled>
                        </div>
                        @if ($chapter->art)
                            <div class="form-group">
                                <label for="">Art Scene</label>
                                <img src="{{  $chapter->art }}" alt="art scene of {{ $chapter->title }}" class="img-fluid">
                            </div>
                            <div class="form-group">
                                <label for="">Art Cost</label>
                                <input type="text" class="form-control" value="{{ $chapter->art_cost}}" disabled>
                            </div>
                        @endif
                        @if ($book->category == 'Novel' || $book->category == 'Anthology')
                            <div>
                                <label for="" class="d-block">Content</label>
                                <textarea name="content" id="nice" cols="30" rows="10">
                                    {{ $chapter->content }}
                                </textarea>
                            </div>
                        @else
                        <div class="justify-content-center d-flex">
                            <iframe src="{{ $chapter->content }}#toolbar=0" width="100%" height="500px" style="border-0">
                            </iframe>
                        </div>
                        @endif
                        <button class="mt-2 btn btn-block btn-primary">Save</button>
                    </form>
                    @else 
                    {{-- if series --}}
                    @endif
                    <div class="mt-5">
                        <button class="btn btn-danger">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        <button class="btn btn-secondary">
                            <i class="fa fa-paper-plane"></i> Send Ticket
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Reports
                </div>
                <div class="card-body">
                    <div>
                        Readers
                    </div>
                    <div>
                        Hearts
                    </div>
                    <div>
                        Reviews & Comments
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
     //rich editor
     CKEDITOR.replace('nice',{height:"50vh", toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        }
      ],});
</script>
@endsection