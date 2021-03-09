<?php

namespace App\Http\Livewire\Admin;

use App\Art;
use App\Book;
use App\Audio;
use App\Thrailer;
use Livewire\Component;

class RecommendationCreate extends Component
{
    public $type = "";
    public $options = [];

    public function updatedType(){
        switch($this->type){

            case 'Book': $this->options = Book::whereNotNull('publish_date')->get();break;
            case 'Art': $this->options = Art::get();break;
            case 'Audio':$this->options = Audio::whereNotNull('publish_date')->get();break;
            case 'Thrailer':$this->options = Thrailer::whereNotNull('approved')->get();break;
        }
    }
    
    public function render()
    {
        return view('livewire.admin.recommendation-create');
    }
}
