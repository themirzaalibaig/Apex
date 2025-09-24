<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTag extends Model
{
    protected $fillable = [
        'name',
        'service_id',
    ];

    /**
        * Get the service for the service tag.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
