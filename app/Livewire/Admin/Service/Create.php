<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Create extends Component
{
    public $service;

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|string|max:255')]
    public $slug = '';

    public $description = '';

    #[Validate('required|string|max:255')]
    public $status = 'active';

    #[Validate('required|string|max:255')]
    public $tags = '';


    public function save(){
        $this->validate();

        $service = Service::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'tags' => $this->tags,
        ]);
        session()->flash('success', 'Service created successfully!');
        $this->redirect('/admin/services', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.service.create');
    }
}
