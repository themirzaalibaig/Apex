<?php

namespace App\Models;

use App\Models\Concerns\HasImages;
use App\Models\Concerns\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Review extends Model
{
    use HasImages;
    use HasMedia;

    protected $fillable = [
        'name',
        'designation',
        'email',
        'rating',
        'review',
        'status',
    ];
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
