<?php

namespace App\Models;

use App\Models\Concerns\HasImages;
use App\Models\Concerns\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Service extends Model
{
    use HasImages;
    use HasMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'tags',
    ];
    /**
     * Get the images for the service.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
