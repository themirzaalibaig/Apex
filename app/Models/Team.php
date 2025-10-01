<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Team extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'email',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'github',
        'status',
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
