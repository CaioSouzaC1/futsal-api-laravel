<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = "teams";

    protected $fillable = [
        "name",
        "points",
        "goals",
        "scored_goals",
        "conceded_goals",
        "wins",
        "defeats"
    ];
}
