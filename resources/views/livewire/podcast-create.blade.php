<div>
    <div>
        <div class="form-group">
            <label for="">Type Of Work</label>
            <select name="type_of_work" wire:model="type_of_work" id="tw" class="custom-select" >
                <option value="solo">Solo</option>
                <option value="collaboration">Collaboration</option>
            </select>
            @if ($type_of_work == 'collaboration')
                <div class="form-group mt-3">
                    <label for="">Select Group</label>
                    <select name="group_id" id="group_id" wire:model="group_id" class="custom-select">
                        <option value="" disabled selected>---</option>
                        @foreach (auth()->user()->groups as $group)
                            <option value="{{ $group->id }}">
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="">
                Is this part of a series or a stand-alone episode? 
            </label>
            <select name="part_of" wire:model="part_of" id="part_of" class="custom-select" x-on:change="updateisSeries()" required>
                <option value="" disabled selected>---</option>
                <option value="standalone">Stand-Alone</option>
                <option value="series">Series</option>
            </select>
        </div>
        @if ($part_of == 'series')
            <div>
                <div class="form-group">
                    <label for="">Select Series</label>
                    <select wire:model="series_id" name="series_id" id=""  class="custom-select" required>
                        <option value="" selected disabled>---</option>
                        @foreach ($series as $s)
                            <option value="{{ $s->id }}">{{ $s->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" x-data="
                    {
                        check(){
                            document.getElementById('episode_num').value = document.getElementById('episode_num').value < 0 ? '' : document.getElementById('episode_num').value;
                        }
                    }
                ">
                    <label for="">Episode Number</label>
                    <input type="number" id="episode_num" wire:model="latestEpisode" x-on:input="check()" name="episode_number" min="1"  class="form-control">
                </div>
            </div>
        @endif
    </div>
    
    <div class="form-group">
        <label for="">Host</label>
        @if ($type_of_work == 'collaboration')
        <input type="text" name="host" class="form-control" required>
        @else 
        <select name="host" id="" class="custom-select" required>
            @foreach (auth()->user()->pens as $pen)
                <option value="{{ $pen->name }}">{{ $pen->name }}</option>
            @endforeach
        </select>
        @endif
    </div>
</div>
