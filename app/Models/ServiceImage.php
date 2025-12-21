<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceImage extends Model
{
    protected $fillable = [
        'service_id',
        'image_path',
        'description',
        'created_by',
    ];

    /**
     * Get the service that owns this image.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }

    /**
     * Get the user who created this service image.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
