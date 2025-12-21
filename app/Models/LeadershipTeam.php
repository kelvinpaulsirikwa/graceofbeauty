<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadershipTeam extends Model
{
    protected $primaryKey = 'leadership_team_id';
    
    public $incrementing = true;

    protected $fillable = [
        'name',
        'rank',
        'phonenumber',
        'facebook',
        'gmail',
        'instagram',
        'description',
        'image',
        'created_by',
    ];

    /**
     * Get the user who created this leadership team member.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

