<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;

class View extends Component
{
    public Service $service;

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.admin.service.view');
    }
}
