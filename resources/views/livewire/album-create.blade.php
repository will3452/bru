<div>
    <div class="form-group">
        <label for="">
            What type of album do you wish to create ?
        </label>
        <select name="type" id="" wire:model="type" class="custom-select" required>
            <option value="" disabled selected>---</option>
            <option value="song">Song</option>
            <option value="art">Art Scenes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">
            Is this a solo album or a collaboration ? 
        </label>
        <select name="type_of_work" wire:model="type_of_work" id="" class="custom-select" required>
            <option value="">---</option>
            <option value="solo">Solo</option>
            <option value="collaboration">Collaboration</option>
        </select>
    </div>

    @if ($type == 'song')
       @if ($type_of_work =='collaboration')
           <div class="form-group">
                <label for="">
                    Do you have a Band ?
                </label>
                <select  required class="custom-select" wire:model="hasBand">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
       @endif

       @if ($hasBand == 'yes')
           
            <div class="form-group">
                <label for="">Select Band from your group(s)</label>
                <select  required class="custom-select" name="group_id">
                    @foreach (auth()->user()->groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

       @endif
    @endif

    
</div>