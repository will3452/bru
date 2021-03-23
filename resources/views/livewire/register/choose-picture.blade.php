<div>
    @if ($picture)
        <div class="form-group">
            <img src="{{ $picture->temporaryUrl()  }}" alt="" id="profile_view" style="object-fit:cover" width="100" height="100" >
        </div>
    @else
    <div class="form-group">
        <img src="{{ asset('img/emptyuserimage.png') }}" alt="" id="profile_view" style="object-fit:cover" width="100" height="100" >
    </div>
    @endif
    <div class="custom-file">
        <label class="custom-file-label" for="picture">Choose Account Picture</label>
        <input wire:model="picture" type="file"  name="picture" id="picture" accept="image/*" required class="custom-file-input">
        <input type="hidden" name="file_url" required wire:model="path">
        @error('picture') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div wire:loading wire:target="picture" >Please wait, Uploading <img src="{{ asset('/images/loading.gif') }}" alt="" style="width: 20px; height:20px;"></div>
</div>