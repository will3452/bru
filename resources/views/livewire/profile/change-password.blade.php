<div>
    <div>
        Change Password
    </div>
    <div class="row">
        <div class="col">
            @if (!$got_current_password && !$first)
                <div class="alert alert-warning">
                    Please enter your correct current password.
                </div>
            @endif
            <div class="form-group focused">
                <input  wire:model.1s="password" type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password">
            </div>
            <div class="alert alert-sm alert-info" wire:loading wire:target="password">
                Checking ...
            </div>
        </div>
        @if ($got_current_password)
            <div class="col-lg-4">
                <div class="form-group focused">
                    <input wire:model="password1" type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group focused">
                    <input wire:model="password2" type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                    @if ($notMatch)
                    <div class="text-sm text-danger">
                        Password not match!
                    </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>