<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use Illuminate\View\View;

class ToggleSwitch extends Component
{
    public string $status;
    public string $name;
    public bool $isActive;
    public string $label;
    public string $description;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $status = 'inactive',
        string $name = 'status',
        string $label = 'Status',
        string $description = 'Toggle to enable or disable this service.'
    ) {
        $this->status = in_array($status, ['active', 'inactive']) ? $status : 'inactive';
        $this->name = $name;
        $this->label = $label;
        $this->description = $description;
        $this->isActive = $this->status === 'active';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.admin.toggle-switch');
    }
}
