<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use Illuminate\View\View;

class TagsInput extends Component
{
    public array $initialTags;
    public int $maxTags;
    public int $maxTagLength;
    public string $name;
    public string $placeholder;

    /**
     * Create a new component instance.
     */
    public function __construct(
        array $initialTags = [],
        int $maxTags = 10,
        int $maxTagLength = 50,
        string $name = 'tags',
        string $placeholder = 'Add tags (press Enter or comma)'
    ) {
        $this->initialTags = $initialTags;
        $this->maxTags = $maxTags;
        $this->maxTagLength = $maxTagLength;
        $this->name = $name;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.admin.tags-input');
    }
}
