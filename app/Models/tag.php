<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'tag',
        'description'
    ];

    /**
     * The games that belong to the tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games()
    {
        return $this->belongsToMany(game::class);
    }
}
