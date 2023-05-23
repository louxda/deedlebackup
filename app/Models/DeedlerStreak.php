<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeedlerStreak extends Model
{
    use HasFactory;

    protected $fillable = [
        "deedler_id",
        "days_count",
    ];

    protected $hidden = [
        "id",
        "created_at",
        "updated_at",
    ];
}
