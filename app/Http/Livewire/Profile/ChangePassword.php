<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{
    public $got_current_password = false;
    public $password = "";
    public $password1 = "";
    public $password2 = "";
    public $notMatch = false;

    public $first = true;
    public function updatedPassword($val){
        $this->got_current_password = Hash::check($val, auth()->user()->password);
        $this->first = false;
    }

    public function updatedPassword2($val){
        if($this->password1 != $val){
            $this->notMatch = true;
        }else {
            $this->notMatch = false;
        }
    }
    
    public function render()
    {
        return view('livewire.profile.change-password');
    }
}
