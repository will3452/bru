<?php

namespace App\Http\Livewire\Admin;

use App\Group;
use Livewire\Component;

class GroupList extends Component
{
    public $unapproved = null;
    public $approved = null;

    public function mount(){
        $this->approved = Group::APPROVED() ?? [];
        $this->unapproved = Group::UNAPPROVED() ?? [];
    }

    public function render()
    {
        return view('livewire.admin.group-list');
    }
}
