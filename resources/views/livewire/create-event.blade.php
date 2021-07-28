<form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="">Event Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
        <label for="">Hosted By</label>
        <select name="hosted_by" id="" class="custom-select select2">
            @foreach(auth()->user()->pens as $pen)
            <option value="{{ $pen->name }}">{{ $pen->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <div class="form-group">
            <label for="">
                Is this event for specific works?
            </label>
            <div class="d-flex">
                <div class="mr-4">
                    <input type="radio" value="yes" wire:model="work">
                    Yes
                </div>
                <div class="mr-4">
                    <input type="radio" value="no" wire:model="work">
                    No
                </div>
            </div>
        </div>
        @if ($work == 'yes')
            <div class="form-group">
                <label for="">
                    Please choose type of content launch.
                </label>
                <div class="d-flex">
                    <div class="mr-4">
                        <input type="radio" value="solo" wire:model="content" name="part_of">
                        Solo Content
                    </div>
                    <div class="mr-4">
                        <input type="radio" value="group" wire:model="content" name="part_of">
                        Group Content
                    </div>
                </div>
            </div>
            @if ($content == 'solo')
                <div class="form-group">
                    <label for="">Please choose what type of your work?</label>
                    <div class="d-flex">
                        <div class="mr-4">
                            <label for="">
                                <input type="radio" value="book" wire:model="worktype" name="work_type">
                            Book
                            </label>
                        </div>
                        <div class="mr-4">
                            <label for="">
                                    <input type="radio" value="art" wire:model="worktype" name="work_type">
                                Art Scene
                            </label>
                        </div>
                        <div class="mr-4">
                            <label for="">
                                <input type="radio" value="film" wire:model="worktype" name="work_type">
                            Film
                            </label>
                        </div>
                        <div class="mr-4">
                            <label for="">
                                <input type="radio" value="song" wire:model="worktype" name="work_type">
                            Song
                            </label>
                        </div>
                        <div class="mr-4">
                            <label for="">
                                <input type="radio" value="audio" wire:model="worktype" name="work_type">
                            Audio Book
                            </label>
                        </div>
                        <div class="mr-4">
                            <label for="">
                                <input type="radio" value="podcast" wire:model="worktype" name="work_type">
                            Podcast
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">
                        Please choose which Work you wish to put up for the event.
                    </label>
                    
                    <select name="work_id" id="" required class="custom-select">
                        <option value="" selected disabled>---</option>
                        @foreach ($works as $w)
                            <option value="{{ $w->id }}">
                                {{ $w->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if ($content == 'group')
                <div class="form-group">
                    <label for="">
                        Please select which type of group content  ?
                    </label>
                    <div class="d-flex">
                        <div class="mr-4">
                            <input type="radio" value="series" wire:model="grouptype" name="group_type">
                            Series
                        </div>
                        <div class="mr-4">
                            <input type="radio" value="collection" wire:model="grouptype" name="group_type">
                            Collection
                        </div>
                        <div class="mr-4">
                            <input type="radio" value="album" wire:model="grouptype" name="group_type">
                            Album
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">
                        Please choose which SERIES/COLLECTION/ALBUM you wish to put up for the event.
                    </label>
                    <select name="group_id" id="" required class="custom-select">
                        <option value="" selected disabled>---</option>
                        @foreach ($groups as $w)
                            <option value="{{ $w->id }}">
                                {{ $w->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        @endif
        
    </div>
    
    <div class="form-group">
        <label for="">Date</label>
        <input type="date" class="form-control" name="date" required>
        <div class="alert alert-warning d-flex mt-2">
            <i class="fa fa-info mr-2"></i>
            <div>
                Event should at least be {{ \App\Setting::find(1)->event_day_away }} days away.
            </div>
        </div>
    </div>
    <div class="form-group">
        
        <label for="">
            Event Description
        </label>
        <textarea name="desc" id="" cols="30" rows="5" required class="form-control"></textarea>
        <div class="alert alert-warning mt-2">
            Describe the event to lure the users in. 
        </div>
    </div>
    <div class="form-group">
        <label for="">Type</label>
        <select name="type" id="" class="select2 custom-select">
            <option value="Quiz Game">Quiz Game</option>
            <option value="Slots Machine">Slots Machine</option>
            <option value="Wheel">Wheel</option>
            <option value="Puzzle Game">Puzzle Game</option>
        </select>
    </div>
    <div class="alert alert-warning d-flex">
            <i class="fa fa-info mr-2"></i>
            <div>
                <ul>
                    <li>Students shall be required to pay CRYSTAL to participate in your event.</li>
                    <li>Please select whether entry cost is WHITE CRYSTAL or PURPLE CRYSTAL.</li>
                    <li>Please set how many CRYSTAL will you be requiring from the students.</li>
                </ul>
            </div>
    </div>
    <div class="form-group">
        <label for="">Crystal Type</label>
        <select name="gem" id="" class="custom-select">
            <option value="purple">PURPLE</option>
            <option value="white">WHITE</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Entry Cost</label>
        <input type="text" name="cost" class="form-control" required>
    </div>
    <div class="form-group">
        <button class="btn btn-block btn-primary">Create</button>
    </div>
</form>
