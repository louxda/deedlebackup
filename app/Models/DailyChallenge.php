<?php

namespace App\Models;

use App\Facades\DeedlerFacade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class DailyChallenge extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        "title",
        "dated_for",
        "challenge_number"
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
    ];

    protected $appends = [
        "has_completed",
    ];

    protected $allowedFilters = [
        'id',
        'title',
        'challenge_number',
        'dated_for',
        "created_at",
        "updated_at",
    ];

    protected $allowedSorts = [
        'id',
        'title',
        'challenge_number',
        'dated_for',
        "created_at",
        "updated_at",
    ];

    protected $casts = [
//        "dated_for" => "datetime",
    ];

    public function getHasCompletedAttribute()
    {
        if (DeedlerFacade::getDeedler() == null) {
            return false;
        }
        return DeedlerChallenge::query()->where("deedler_id", "=", DeedlerFacade::getDeedler()->id)->where("challenge_id", "=", $this->id)->exists();
    }
}
