<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;

class Index extends Component
{
    public $services;

    public function mount()
    {
        $this->services = Service::with('images')->get();
    }

    public function render()
    {
        return view('livewire.admin.service.index');
    }
}
