<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    protected $primaryKey = 'brand_id';
    
    public $incrementing = true;

    protected $fillable = [
        'brand_name',
        'image',
        'created_by',
    ];

    /**
     * Get the user who created this brand.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
