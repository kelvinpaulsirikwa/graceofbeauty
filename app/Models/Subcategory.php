<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subcategory extends Model
{
    protected $primaryKey = 'subcategory_id';
    
    public $incrementing = true;

    protected $fillable = [
        'category_id',
        'subcategory_name',
        'created_by',
    ];

    /**
     * Get the category that owns this subcategory.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    /**
     * Get the user who created this subcategory.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
