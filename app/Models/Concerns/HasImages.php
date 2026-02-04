<?php

namespace App\Models\Concerns;

use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;

trait HasImages
{
    public function imageByType(string $type): ?Image
    {
        /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images */
        $images = $this->relationLoaded('images') ? $this->images : $this->images()->get();

        return $images->firstWhere('type', $type) ?? $images->firstWhere('alt', $type);
    }
}
