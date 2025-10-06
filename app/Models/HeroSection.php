<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class HeroSection extends Model
{
    protected $fillable = ['subtitle', 'title1', 'title2', 'cta', 'cta_url', 'status'];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
