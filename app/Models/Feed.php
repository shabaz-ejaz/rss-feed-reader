<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'user_id',
    ];

    /**
     * Get the user that owns the feed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
