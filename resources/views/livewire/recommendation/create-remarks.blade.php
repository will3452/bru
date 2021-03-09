<div>
    <div class="alert alert-info" wire:loading wire:target="submit">
        Loading...
    </div>
    <form action="#" wire:submit.prevent="submit">
        
        <div class="card">
            <h4 class="card-header">
                Create Remark
            </h4>
            <div class="card-body">
                <div class="form-group">
                    <label for="" >Remarks</label>
                    <div class="input-group">
                        <input type="text" wire:model.lazy="value" class="form-control">
                        <button   class="btn btn-primary input-group-append">Add</button>
                    </div>
                    @error('value')
                        <div class="alert alert-warning">
                            {{$message}}
                        </div>
                    @enderror
                    @if ($done)
                        <div class="text-success">
                            Remark Added.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
