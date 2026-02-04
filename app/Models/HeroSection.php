<?php

namespace App\Models;

use App\Models\Concerns\HasImages;
use App\Models\Concerns\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class HeroSection extends Model
{
    use HasImages;
    use HasMedia;

    protected $fillable = ['subtitle', 'title1', 'title2', 'cta', 'cta_url', 'status'];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
