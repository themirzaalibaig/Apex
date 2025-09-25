<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;

class ToggleSwitch extends Component
{
    public $status = 'inactive';
    public $name = 'status';

    // Internal boolean for Flux switch binding
    public bool $isActive = false;

    public function mount($status = 'inactive', $name = 'status')
    {
        $this->status = in_array($status, ['active', 'inactive']) ? $status : 'inactive';
        $this->name = $name;
        $this->isActive = $this->status === 'active';
    }

    // Sync boolean change back to string
    public function updatedIsActive($value)
    {
        $this->status = $value ? 'active' : 'inactive';
    }

    public function render()
    {
        return view('livewire.components.admin.toggle-switch');
    }
}
