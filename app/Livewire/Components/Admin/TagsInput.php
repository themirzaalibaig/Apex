<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;

class TagsInput extends Component
{
    public $tags = [];
    public $input = '';
    public $initialTags = '';
    public $maxTags = 10;
    public $maxTagLength = 50;

    protected $rules = [
        'tags' => 'array|max:10',
        'input' => 'nullable|string|max:50',
    ];

    protected $messages = [
        'tags.max' => 'You can add maximum :max tags.',
        'input.max' => 'Each tag can have maximum :max characters.',
    ];

    public function mount($initialTags = '', $maxTags = 10, $maxTagLength = 50)
    {
        $this->initialTags = $initialTags;
        $this->maxTags = $maxTags;
        $this->maxTagLength = $maxTagLength;

        if (!empty($initialTags)) {
            $this->tags = array_filter(array_map('trim', explode(',', $initialTags)));
        }
    }

    public function updatedInput($value)
    {
        // Handle comma or enter key input
        if (str_contains($value, ',')) {
            $this->addTag();
        }
    }

    public function addTag()
    {
        $tag = trim($this->input);

        // Validate tag
        if (empty($tag)) {
            return;
        }

        if (strlen($tag) > $this->maxTagLength) {
            $this->addError('input', "Tag must be less than {$this->maxTagLength} characters.");
            return;
        }

        if (count($this->tags) >= $this->maxTags) {
            $this->addError('tags', "Maximum {$this->maxTags} tags allowed.");
            return;
        }

        if (!in_array(strtolower($tag), array_map('strtolower', $this->tags))) {
            $this->tags[] = $tag;
            $this->resetErrorBag();
        }

        $this->input = '';
        $this->emitTagString();
    }

    public function removeTag($index)
    {
        if (isset($this->tags[$index])) {
            unset($this->tags[$index]);
            $this->tags = array_values($this->tags); // Reindex array
            $this->emitTagString();
            $this->resetErrorBag();
        }
    }

    public function emitTagString()
    {
        $this->dispatch('tagsUpdated', implode(',', $this->tags));
    }

    public function render()
    {
        return view('livewire.components.admin.tags-input');
    }
}
