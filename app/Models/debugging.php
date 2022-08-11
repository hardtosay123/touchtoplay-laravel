<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class debugging extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'script',
        'game_id',
        'user_id'
    ];

    /**
     * Get the game that owns the debugging
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo(game::class);
    }

    /**
     * Get the user that owns the debugging
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
