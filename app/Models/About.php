<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class About extends Model
{
    protected $fillable = ['video','title', 'subtitle', 'description', 'skills', 'cta', 'cta_url', 'statistics'];

    protected $casts = [
        'skills' => 'array',
        'statistics' => 'array',
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
