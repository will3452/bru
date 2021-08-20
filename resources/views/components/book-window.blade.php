@props('book')
<div  class="m-4 text-center " style="position:relative;" x-data="{showInfo:false}" x-on:mouseover="showInfo = true" x-on:mouseout="showInfo = false">
            <div  id="{{ $book->id }}" style="cursor:pointer;@if(request()->id == $book->id)  box-shadow:0px 0px 10px 10px #1A0A49; @else box-shadow:10px 5px 2px #555 ; @endif height: 200px; width: 150px; background:url('{{ $book->cover }}');background-size:contain;background-position:center;">

            </div>
            <div class="mt-2">
                <a href="{{ route('books.show', $book) }}" style="text-transform:capitalize;">{{ $book->title}}</a>
            </div>
            <div  x-show.transition="showInfo" style="position:absolute;top:-10px;left:100px; height:300px; width:200px;background:rgba(17,0,31, 0.9);z-index:999" >
                <div style="position:absolute;top:6px;left:-14px;height:32px; width:32px;border:4px #014E7F solid;background:url('{{ asset('img/card-bg-custom.png') }}');background-position:center;border-top:none;border-right:none;transform:rotate(45deg);z-index:998;"></div>
                <p class="text-white p-2" style="text-transform:capitalize;height:45px;box-shadow:0px 5px #000;border:4px #014E7F solid;border-left:none; background:url('{{ asset('img/card-bg-custom.png') }}');background-position:center;z-index:999;">
                    {{ Str::limit($book->title, 10) }}
                </p>
                <div class="px-2 text-left text-white" style="text-transform:capitalize;">
                    <div class="mt-1">
                        Type: {{ $book->class }}
                    </div>
                    <div class="mt-1">
                        Category: {{ $book->category }}
                    </div>
                    <div class="mt-1">
                        Language: {{ $book->language }}
                    </div>
                    <div class="mt-1">
                        Cost: {{ $book->cost == 0 ? 'FREE':$book->cost }}
                    </div>
                    <div class="mt-1" style="border:1px solid white;"></div>
                    <div class="mt-1">
                        Date Uploaded: {{ $book->created_at->format('m/d/y') }}
                    </div>
                    <div class="mt-1">
                        Is Published: {{ $book->publish_date ?? 'No' }}
                    </div>
                    <div class="mt-1" style="border:1px solid white;"></div>
                    <div class="mt-1">
                        Ratings: ---
                    </div>
                    <div class="mt-1">
                        Comments: ---
                    </div>
                    <div class="mt-1">
                        Likes: ---
                    </div>
                </div>
            </div>
        </div>