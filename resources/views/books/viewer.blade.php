@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Content preview of '.$book->title) }}</h1>
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back to Book Details</a>
    </div>
    <div>
        
        @if($book->category == 'Novel' || $book->category == 'Anthology')
        <div class="mb-2 text-center d-none d-lg-block">
            <button class="btn btn-primary btn-sm btn-viewer"><i class="fa fa-desktop"></i></button>
            <button class="btn btn-outline-primary btn-sm btn-viewer" onclick="toSmall()"><i class="fa fa-mobile-alt"></i></button>
        </div>
        {{-- iteratin for novel books --}}
            @foreach($pages as $chapter)
            <div class="d-flex justify-content-center ">
               <div class="bg-white p-5  shadow w-100" id="page">
                   @if ($chapter->mode == 'chapter')
                    <strong class="d-block text-lg">Chapter {{ $chapter->sq }}</strong>
                    @else
                    <strong class="d-block text-lg"><span style="text-transform:capitalize;">{{ $chapter->mode }}</span></strong>
                   @endif
                    <strong class="d-block text-lg">{{ $chapter->title }}</strong>
                    <div id="page-content">
                        {!! $chapter->content !!}
                    </div>
               </div>
            </div>
            @endforeach
            
        @elseif($book->category == 'Series')
            @foreach($book->books as $book)
                <div class="col-md-2 col-6 text-center all {{ $book->class }} {{ empty($book->published_date)  ? 'published':'not-yet'}}">
                
                        <div class="parent">
                            <img src="{{ $book->cover }}" alt="" class="child">
                            <div class="parent-title">
                                <strong class="text-lg text-light px-2 text-uppercase">
                                    <a href="{{ route('books.show', $book) }}" class="link-{{ $book->id }}"> {{ $book->title }} </a>
                                </strong>
                            </div>
                        </div>
                        <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
                </div>
            @endforeach
        @else
        {{-- iteration for illustrated books  --}}
            @foreach($pages as $chapter)
            <h3 class="text-center">
                @if ($chapter->mode == 'chapter')
                <strong class="d-block text-lg">Chapter {{ $chapter->sq }}</strong>
                @else
                <strong class="d-block text-lg"><span style="text-transform:capitalize;">{{ $chapter->mode }}</span></strong>
               @endif
            </h3>
            <div class="text-center">
                <strong>
                    {{ $chapter->title }}
                </strong>
            </div>
            <div class="justify-content-center d-flex">
                <iframe src="{{ $chapter->content }}#toolbar=0" width="100%" height="500px" style="border-0">
                </iframe>
            </div>
            @endforeach
        @endif
        <div class="mt-2 justify-content-center d-flex">
            {{ $pages->links() }}
        </div>
    </div>
@endsection

@section('top')
    <style>
        .small-view{
            width: 300px  !important;
            height: 500px !important;
            padding:10px !important;
            overflow: scroll;
            font-size: 75%;
        }
        /* #page-content::first-line{
            text-indent: 10% !important;
        } */
    </style>
@endsection
@section('bottom')
    <script>
        $(function(){
            $('.btn-viewer').click(function(){
                $('.btn-viewer').removeClass('btn-primary').addClass('btn-outline-primary');
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $('#page').toggleClass('small-view');
            })
            
        });
    </script>
@endsection
