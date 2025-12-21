<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductAttribute extends Model
{
    protected $fillable = [
        'name',
        'posted_by',
    ];

    /**
     * Get the user who posted this product attribute.
     */
    public function poster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    /**
     * Get the products that have this attribute.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_attribute_values',
            'product_attribute_id',
            'product_id',
            'id',
            'product_id'
        )->withPivot('value')
          ->withTimestamps();
    }
}
