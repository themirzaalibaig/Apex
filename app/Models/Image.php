<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = [
        'name',
        'alt',
        'title',
        'caption',
        'keywords',
        'image',
        'imageable_id',
        'imageable_type',
        'status',
    ];

    /**
     * Get the imageable for the image.
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
