<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Deedler extends Model
{
    use HasFactory;
    use AsSource;
    use Chartable;
    protected $fillable = [
        "cookie",
        "name",
    ];


    public static function createDeedleerWithCookie($cookie): Deedler|Model
    {
        return static::query()->create([
            "cookie" => $cookie,
        ]);
    }

    public static function findDeedlerByCookie($cookie)
    {
        return Deedler::query()->where("cookie", "=", $cookie)->first();
    }

}
