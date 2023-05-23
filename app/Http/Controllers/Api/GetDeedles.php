<?php

namespace App\Http\Controllers\Api;

use App\Models\DailyChallenge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GetDeedles
{
    public function __invoke(Request $request)
    {

        $clientToday = Carbon::now($request->query("zone"));
        $todaysDeedle = DailyChallenge::query()->whereDate("dated_for", "=", $clientToday->toDate())->first();
        $nextDeedle = DailyChallenge::query()->whereDate("dated_for", ">", $clientToday->toDate())->orderBy("dated_for")->first();
        return new JsonResponse([
            "todaysDeedle" => $todaysDeedle,
            "nextDeedle"   => $nextDeedle,
        ]);
    }
}