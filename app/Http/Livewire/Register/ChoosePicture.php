<?php

namespace App\Http\Livewire\Register;

use Livewire\Component;
use Livewire\WithFileUploads;

class ChoosePicture extends Component
{
    use WithFileUploads;
    public $picture;
    public $path;
    public function updatedPicture(){
        $path = $this->picture->store('public/userpictures');
        $arr_path = explode('/', $path);
        $end_path = end($arr_path);
        $this->path = '/storage/userpictures/'.$end_path;
    }
    public function render()
    {
        return view('livewire.register.choose-picture');
    }
}
