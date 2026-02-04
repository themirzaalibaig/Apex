<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Upload extends Model
{
    protected $fillable = [
        'file_name',
        'public_id',
        'url',
        'resource_type',
        'seo_alt_text',
        'seo_meta_title',
        'seo_meta_description',
        'seo_meta_keywords',
        'is_active',
        'is_deleted',
        'deleted_at',
    ];

    protected $casts = [
        'seo_meta_keywords' => 'array',
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    public function usages(): HasMany
    {
        return $this->hasMany(MediaUsage::class);
    }
}
