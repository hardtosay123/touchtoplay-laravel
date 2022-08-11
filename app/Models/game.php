<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'script',
        'image_url',
        'release',
        'status'
    ];

    /**
     * The tags that belong to the game
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(tag::class);
    }

    /**
     * Get all of the debuggings for the game
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function debuggings()
    {
        return $this->hasMany(debugging::class);
    }
}
