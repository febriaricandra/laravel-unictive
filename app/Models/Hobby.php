<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hobby extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id'
    ];

    /**
     * Get the user that owns the hobby.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
