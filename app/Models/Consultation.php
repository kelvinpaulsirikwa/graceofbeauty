<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $primaryKey = 'consultation_id';
    
    public $incrementing = true;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'services',
        'message',
        'read',
    ];

    protected $casts = [
        'read' => 'boolean',
    ];
}
