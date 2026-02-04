<?php

namespace App\View\Components\Admin;

use App\Models\Upload;
use Illuminate\View\Component;
use Illuminate\View\View;

class MediaSelector extends Component
{
    public string $name;
    public array $selected;
    public bool $multiple;
    public string $label;
    public string $description;
    public array $availableUploads;

    public function __construct(
        string $name = 'media_usages',
        array $selected = [],
        bool $multiple = true,
        string $label = 'Select Media',
        string $description = 'Choose existing media or upload new'
    ) {
        $this->name = $name;
        $this->selected = $selected;
        $this->multiple = $multiple;
        $this->label = $label;
        $this->description = $description;

        static $cache = null;
        if ($cache === null) {
            $cache = Upload::where('is_deleted', false)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(fn ($upload) => [
                    'id' => $upload->id,
                    'file_name' => $upload->file_name,
                    'url' => $upload->url,
                    'seo_alt_text' => $upload->seo_alt_text,
                ])
                ->toArray();
        }

        $this->availableUploads = $cache;
    }

    public function render(): View
    {
        return view('components.admin.media-selector');
    }
}
