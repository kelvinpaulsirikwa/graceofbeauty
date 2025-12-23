<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFeedback extends Model
{
    protected $table = 'user_feedbacks';
    
    protected $primaryKey = 'feedback_id';
    
    public $incrementing = true;

    protected $fillable = [
        'image',
        'description',
        'product_used',
        'service_used',
        'created_by',
    ];

    protected $casts = [
        'product_used' => 'array',
        'service_used' => 'array',
    ];

    /**
     * Get the user who created this feedback.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

