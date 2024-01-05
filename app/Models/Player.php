<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model
{
    use HasFactory;

    protected $table = "players";

    protected $fillable = [
        "tshirt",
        "name",
        "team_id"
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
