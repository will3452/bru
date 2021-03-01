<form action="{{ route('thrailers.store') }}" method="POST" enctype="multipart/form-data">
    {{-- <form action="#"> --}}
    @csrf
    <div class="form-group">
        <label for="">Title</label>
        <input type="text" class="form-control" name="title" required>
    </div>
    <div class="form-group">
        <label for="">Author / Artist</label>
        <select name="author" id="" class="custom-select select2">
            @foreach(auth()->user()->pens as $pen)
            <option value="{{ $pen->name }}">
                {{ $pen->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Category</label>
        <select wire:model="category" name="category" id="" class="custom-select">
            <option value="trailer">Trailer</option>
            <option value="film">Film</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" id="" required class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="">Credits</label>
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> This will appear as a page after the video.
        </div>
        <textarea name="credit" id="" required class="form-control"></textarea>
    </div>
    @if($category == 'trailer')
        <div class="form-group">
            <label for="">To which work is this trailer connected to ?</label>
            <select name="connect_id" id="" class="custom-select select2">
                @foreach (\App\Book::get() as $book)
                    <option value="book-{{$book->id}}">
                        {{ $book->title }} (book)
                    </option>
                @endforeach
                @foreach (\App\Thrailer::get() as $trailer)
                    <option value="film-{{$trailer->id}}">
                        {{ $trailer->title }} (trailer/film)
                    </option>
                @endforeach
            </select>
        </div>

    @else
    <div class="form-group">
        <label for="#">Genre</label>
        <select name="genre" id="genre" class="custom-select select2">
            @php
                $first = '';
            @endphp
            @foreach(\App\Genre::get() as $genre)
            @if($loop->first)
                @php
                    $first = $genre;
                @endphp
            @endif
            <option value="{{ $genre->name }}">
                {{ $genre->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Is this part of an events ?</label>
        <div>
            <label for="">
                <input type="checkbox" wire:model="partOfEvent" value="1" checked="{{$partOfEvent == 1}}"> Yes
            </label>
        </div>
    </div>
        @if($partOfEvent == 1)
            <div class="form-group">
                <label for="">Choose an event</label>
                <select name="event_id" id="" class="custom-select select2">
                    @foreach (\App\Event::get() as $event)
                        <option value="{{ $event->id }}">{{$event->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group">
            <label for="">Would you like to download a preview for this film? 15 seconds should be enough. Choose your best scene. </label>
            <div>
                <input type="checkbox" wire:model="hasPreview"> Yes
            </div>
        </div>
        @if ($hasPreview)
            <div class="form-group">
                {{-- <div wire:loading.remove>
                    <video  src="{{ $preview != null ? $preview->temporaryUrl() :'' }}" controls class="col-12 col-md-4"></video>
                </div> --}}
                <input type="file" accept="video/*" name="preview" required>
                <div class="alert alert-warning mt-2">
                    <input type="checkbox" required>
                    @copyright_disclaimer
                </div>
            </div>
            <div class="form-group">
                <label for="">
                    Preview Cost
                </label>
                <input type="text" placeholder="White Gems" required name="preview_cost" class="form-control form-control-sm">
            </div>
        @endif
    @endif
    <hr>
    <div class="form-group">
        <label for="">Age Restriction</label>
        <select name="age_restriction" id="" class="custom-select">
            <option value="none">none</option>
            <option value="16 and up">16 and Up</option>
            <option value="18 and up">18 and Up</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Language</label>
        <select name="language" id="" class="custom-select" required>
            <option value="english">English</option>
            <option value="filipino">Filipino</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Cover</label>
        <div>
            <input type="file" name="cover" accept="image/*" required>
        </div>
    </div>
    <div class="form-group">
        <label for="">Please submit the video for approval to the Admin. </label>
        <input type="file" accept="video/*" class="d-block" name="video" required>

        <div class="alert alert-warning mt-2">
            <input type="checkbox" required name="cpy">
            @copyright_disclaimer
        </div>
    </div>
    <div class="form-group">
        <label for="">Type of Gem</label>
        <select name="gem" id="" class="select2 form-control">
            <option value="White">White Gems</option>
            <option value="Purple">Purple Gems</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Cost</label>
        <input type="number" name="cost" class="form-control" min="0" value="0">
    </div>
    <div class="form-group">
        <button class="btn btn-block btn-primary">
            Submit
        </button>
    </div>
</form>
{{-- <script>
    alert('under development...');
</script> --}}