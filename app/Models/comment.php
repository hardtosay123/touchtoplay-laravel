<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'comment',
        'user_id',
        'blog_id'
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

    public function blog()
    {
        return $this->belongsTo(blog::class);
    }
}
