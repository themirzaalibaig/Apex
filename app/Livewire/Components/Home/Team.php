<?php

namespace App\Livewire\Components\Home;

use App\Models\Team as ModelsTeam;
use Livewire\Component;

class Team extends Component
{
    public $teams;
    public function mount()
    {
        $this->teams = ModelsTeam::With('images')->where('status', 'active')->limit(6)->get();
    }
    public function render()
    {
        return view('livewire.components.home.team');
    }
}
