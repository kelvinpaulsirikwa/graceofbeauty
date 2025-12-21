<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $primaryKey = 'service_id';
    
    public $incrementing = true;

    protected $fillable = [
        'order',
        'service_name',
        'front_image',
        'description',
        'created_by',
    ];

    /**
     * Get the user who created this service.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all images for this service.
     */
    public function serviceImages(): HasMany
    {
        return $this->hasMany(ServiceImage::class, 'service_id', 'service_id');
    }
}
