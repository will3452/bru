<div>
    <div class="form-group input-group">
        <input type="text" class="form-control" wire:model="title" placeholder="Enter Work Title">
    </div>
    <div>
       <ul class="list-group">
        @foreach ($works as $work)
           <li class="list-group-item d-flex justify-content-between">
              <div>
                {{ $work->title }} by {{ $work->author ?? $work->host }}
             </div> 
               <form action="{{ route('series.update', $series->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="work_id" value="{{ $work->id }}">
                    @if (!$work->series()->find($series->id))
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
