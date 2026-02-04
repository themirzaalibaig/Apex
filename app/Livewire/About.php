<?php

namespace App\Livewire;

use App\Models\About as AboutModel;
use Livewire\Component;

class About extends Component
{
    public $about;

    public function mount()
    {
        $this->about = AboutModel::with('mediaUsages.upload')->first();
    }

    public function render()
    {
        return view('livewire.about');
    }
}
