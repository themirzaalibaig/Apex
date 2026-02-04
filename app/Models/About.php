<?php

namespace App\Models;

use App\Models\Concerns\HasImages;
use App\Models\Concerns\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class About extends Model
{
    use HasImages;
    use HasMedia;

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
