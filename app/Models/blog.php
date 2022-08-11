<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    /**
     * Get the user that owns the blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get all of the comments for the blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(comment::class);
    }
}
