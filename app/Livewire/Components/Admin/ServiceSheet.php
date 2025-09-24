<?php

namespace App\Livewire\Components\Admin;

use App\Models\Service;
use App\Models\ServiceTag;
use Livewire\Component;

class ServiceSheet extends Component
{
    public $id = null;
    public $name = '';
    public $slug = '';
    public $description = '';
    public $tags = '';
    public $status = 'active';

    public function mount($id = null)
    {
        $this->id = $id;

        if ($id) {
            $service = Service::findOrFail($id);
            $this->name = $service->name;
            $this->slug = $service->slug;
            $this->description = $service->description;
            $this->status = $service->status;

            // Ensure tags is always a string
            $tags = $service->tags->pluck('name')->toArray();
            $this->tags = is_array($tags) ? implode(', ', $tags) : (string) $tags;
        }
    }

    public function save()
    {
        // Ensure tags is always a string before validation
        $this->tags = is_array($this->tags) ? implode(', ', $this->tags) : (string) $this->tags;

        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services,slug' . ($this->id ? ',' . $this->id : ''),
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'tags' => 'nullable|string',
        ]);

        $service = $this->id ? Service::findOrFail($this->id) : new Service();

        $service->name = $this->name;
        $service->slug = $this->slug;
        $service->description = $this->description;
        $service->status = $this->status;
        $service->save();

        // Handle tags
        if (!empty($this->tags)) {
            $tagNames = array_map('trim', explode(',', $this->tags));
            $tagIds = [];

            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = ServiceTag::firstOrCreate(['name' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }

            $service->tags()->sync($tagIds);
        } else {
            $service->tags()->detach();
        }

        $this->dispatch('service-saved');

        if (!$this->id) {
            $this->reset(['name', 'slug', 'description', 'tags', 'status']);
        }
    }

    public function render()
    {
        return view('livewire.components.admin.service-sheet');
    }
}
