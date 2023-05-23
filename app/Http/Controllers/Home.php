<?php

namespace App\Http\Controllers;

use App\Facades\DeedlerFacade;
use App\Models\DailyChallenge;
use App\Models\DeedlerChallenge;
use App\Models\DeedlerStreak;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use DB;
class Home extends Controller
{
    public function __invoke()
    {
        $deedler = DeedlerFacade::getDeedler();
        $deedles = DailyChallenge::query()->whereDate("dated_for", ">", Carbon::today()->subDays(2))->orderBy("dated_for")->limit(5)->get();

        $deedlesDone = DeedlerChallenge::query()->where("deedler_id", "=", $deedler->id)->count();
        $deedlerStreak = DeedlerStreak::query()->where("deedler_id", "=", $deedler->id)->orderBy("updated_at", 'desc')->first();
        $longestStreak = DeedlerStreak::query()->where("deedler_id", "=", $deedler->id)->orderBy("days_count", "desc")->first();
        $totalDeedlesDone = DeedlerChallenge::query()->count();
        $dailyDeedler =  DeedlerChallenge::query()->whereDate("created_at","=",Carbon::today())->count();
        $dailyDeedlerCounts =  DeedlerChallenge::query()->select('challenge_id', DB::raw('count(*) as total'))->groupBy('challenge_id')
                 ->get()->mapWithKeys(function ($item, $key) {
    return [$item['challenge_id'] => $item['total']];
})->all();
//        $dailyDeedler = DeedlerStreak::query()->orderBy("days_count", "desc")->first();
        return view('home', [

            "deedles"      => $deedles,
            "stats"        => [
                "deedlesDone"      => $deedlesDone,
                "deedlerStreak"    => $deedlerStreak,
                "longestStreak"    => $longestStreak,
                "totalDeedlesDone" => $totalDeedlesDone,
                "dailyDeedler"     => $dailyDeedler,
                'dailyDeedlerCounts'=>$dailyDeedlerCounts
            ],
        ]);
    }

    public function getdeedlercount($id)
    {
        return $id;
    }
}
