<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SubMenu extends Model
{
    protected $fillable = [
        'name',
        'link',
        'menu_id',
        'status',
    ];
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function images(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
