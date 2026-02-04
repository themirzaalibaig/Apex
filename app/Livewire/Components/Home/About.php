<?php

namespace App\Livewire\Components\Home;

use Livewire\Component;
use App\Models\About as ModelsAbout;

class About extends Component
{
    public $about;

    public function mount()
    {
        $this->about = ModelsAbout::with('mediaUsages.upload')->first();
    }

    public function render()
    {
        return view('livewire.components.home.about');
    }
}
