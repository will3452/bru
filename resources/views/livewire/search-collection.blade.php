
<div>
    <div class="form-group input-group">
        <input type="text" class="form-control" wire:model="title" placeholder="Enter Work Title">
    </div>
    <div>
       <ul class="list-group">
        @foreach ($books as $work)
           <li class="list-group-item d-flex justify-content-between">
               <div>
                {{ $work->title }} (Book)
               </div>
               <form action="{{ route('collections.update', $collection->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="work_id" value="{{ $work->id }}">
                <input type="hidden" name="type" value="book">
                    @if (!$work->collections()->find($collection->id))
                        <button class="btn btn-primary btn-sm">
                            add
                        </button>
                    @else 
                        <div>
                            <em>
                                Added
                            </em>
                        </div>
                    @endif
               </form>
           </li>
        @endforeach

        @foreach ($audios as $work)
           <li class="list-group-item d-flex justify-content-between">
               <div>
                {{ $work->title }} (Audio Book)
               </div>
               <form action="{{ route('collections.update', $collection->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="work_id" value="{{ $work->id }}">
                <input type="hidden" name="type" value="audio book">
                    @if (!$work->collections()->find($collection->id))
                        <button class="btn btn-primary btn-sm">
                            add
                        </button>
                    @else 
                        <div>
                            <em>
                                Added
                            </em>
                        </div>
                    @endif
               </form>
           </li>
        @endforeach

        @foreach ($arts as $work)
           <li class="list-group-item d-flex justify-content-between">
               <div>
                {{ $work->title }} (Art Scence)
               </div>
               <form action="{{ route('collections.update', $collection->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="work_id" value="{{ $work->id }}">
                <input type="hidden" name="type" value="art">
                    @if (!$work->collections()->find($collection->id))
                        <button class="btn btn-primary btn-sm">
                            add
                        </button>
                    @else 
                        <div>
                            <em>
                                Added
                            </em>
                        </div>
                    @endif
               </form>
           </li>
        @endforeach
        @foreach ($podcasts as $work)
           <li class="list-group-item d-flex justify-content-between">
               <div>
                {{ $work->title }} (Podcast)
               </div>
               <form action="{{ route('collections.update', $collection->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="work_id" value="{{ $work->id }}">
                <input type="hidden" name="type" value="podcast">
                    @if (!$work->collections()->find($collection->id))
                        <button class="btn btn-primary btn-sm">
                            add
                        </button>
                    @else 
                        <div>
                            <em>
                                Added
                            </em>
                        </div>
                    @endif
               </form>
           </li>
        @endforeach

        @foreach ($songs as $work)
           <li class="list-group-item d-flex justify-content-between">
               <div>
                {{ $work->title }} (Song)
               </div>
               <form action="{{ route('collections.update', $collection->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="work_id" value="{{ $work->id }}">
                <input type="hidden" name="type" value="song">
                    @if (!$work->collections()->find($collection->id))
                        <button class="btn btn-primary btn-sm">
                            add
                        </button>
                    @else 
                        <div>
                            <em>
                                Added
                            </em>
                        </div>
                    @endif
               </form>
           </li>
        @endforeach

        @foreach ($films as $work)
           <li class="list-group-item d-flex justify-content-between">
               <div>
                {{ $work->title }} (Film)
               </div>
               <form action="{{ route('collections.update', $collection->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="work_id" value="{{ $work->id }}">
                <input type="hidden" name="type" value="film">
                    @if (!$work->collections()->find($collection->id))
                        <button class="btn btn-primary btn-sm">
                            add
                        </button>
                    @else 
                        <div>
                            <em>
                                Added
                            </em>
                        </div>
                    @endif
               </form>
           </li>
        @endforeach


        
       </ul>
    </div>
    @empty($works)
        @if ($title == '')
            ----
        @else
            No work found.
        @endif
    @endempty
</div>
