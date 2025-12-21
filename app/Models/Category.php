<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    
    public $incrementing = true;

    protected $fillable = [
        'category_name',
        'front_image',
        'created_by',
    ];

    /**
     * Get the user who created this category.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the subcategories for this category.
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'category_id');
    }
}
