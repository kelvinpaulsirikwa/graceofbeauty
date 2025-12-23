<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    
    public $incrementing = true;

    protected $fillable = [
        'name',
        'brand_id',
        'category_id',
        'subcategory_id',
        'front_image',
        'price',
        'offer',
        'offer_price',
        'available',
        'created_by',
    ];

    protected $casts = [
        'available' => 'boolean',
        'offer' => 'boolean',
    ];

    /**
     * Get the brand that owns this product.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    /**
     * Get the category that owns this product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    /**
     * Get the subcategory that owns this product.
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'subcategory_id');
    }

    /**
     * Get the user who created this product.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the product attributes with their values for this product.
     */
    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductAttribute::class,
            'product_attribute_values',
            'product_id',
            'product_attribute_id',
            'product_id',
            'id'
        )->withPivot('value')
          ->withTimestamps();
    }

    /**
     * Get all product attribute value records for this product.
     */
    public function productAttributeValues(): HasMany
    {
        return $this->hasMany(ProductAttributeValue::class, 'product_id', 'product_id');
    }

    /**
     * Get all images for this product.
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }

    /**
     * Check if the product is new (created within the last week).
     *
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->created_at && $this->created_at->isAfter(now()->subWeek());
    }
}
