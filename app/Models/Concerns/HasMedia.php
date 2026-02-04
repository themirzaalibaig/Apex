<?php

namespace App\Models\Concerns;

use App\Models\MediaUsage;
use App\Models\Upload;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasMedia
{
    public function mediaUsages(): HasMany
    {
        return $this->hasMany(MediaUsage::class, 'ref_id', 'id')
            ->where('ref_type', static::class)
            ->where('is_deleted', false);
    }

    public function mediaByType(string $type): ?Upload
    {
        $usages = $this->relationLoaded('mediaUsages') ? $this->mediaUsages : $this->mediaUsages()->get();
        $usage = $usages->firstWhere('type', $type);
        if (!$usage) {
            return null;
        }

        return $usage->relationLoaded('upload') ? $usage->upload : $usage->upload()->first();
    }

    public function mediaFirst(): ?Upload
    {
        $usage = $this->relationLoaded('mediaUsages') ? $this->mediaUsages->first() : $this->mediaUsages()->first();
        if (!$usage) {
            return null;
        }

        return $usage->relationLoaded('upload') ? $usage->upload : $usage->upload()->first();
    }
}
