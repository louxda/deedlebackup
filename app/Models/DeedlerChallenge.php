<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class DeedlerChallenge extends Model
{
    use HasFactory;
    use AsSource;
    use Chartable;

    protected $fillable = [ "deedler_id", "challenge_id" ];

    protected $hidden = [
        "id",
        "created_at",
        "updated_at",
    ];
}
