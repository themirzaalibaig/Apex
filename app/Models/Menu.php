<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'link',
        'status',
    ];
    public function subMenus(): HasMany
    {
        return $this->hasMany(SubMenu::class, 'menu_id');
    }
}
