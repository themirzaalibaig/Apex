<?php

namespace App\Livewire\Components\Home;

use App\Models\Project;
use Livewire\Component;

class Portfolio extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::with('mediaUsages.upload')->where('status', 'active')->get();
    }

    public function render()
    {
        return view('livewire.components.home.portfolio');
    }
}
