<?php

namespace App\Http\Controllers;

use App\Facades\DeedlerFacade;
use App\Models\Deedler;
use App\Models\DeedlerChallenge;
use App\Models\DeedlerStreak;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DeedleCompleted
{
    public function __invoke(Request $request)
    {
        /** @var Deedler $deedler */
        $deedler = DeedlerFacade::getDeedler();
        /** @var DeedlerChallenge $created */
        $created = DeedlerChallenge::query()->create([
            "deedler_id"   => $deedler->id,
            "challenge_id" => $request->input("deedleId"),
        ]);
        $created->refresh();
        $this->updateDeedlerStreak($created);
        return redirect("/");
    }

    protected function updateDeedlerStreak(DeedlerChallenge $doneDeedle)
    {
        $yesterdaysDeedle = DeedlerChallenge::query()->where("deedler_id", "=", $doneDeedle->deedler_id)->whereDate("created_at", "=", Carbon::yesterday())->first();
        if (!$yesterdaysDeedle instanceof DeedlerChallenge) {
            DeedlerStreak::query()->create([
                "deedler_id" => $doneDeedle->deedler_id,
                "days_count" => 1,
            ]);
            return;
        }
        $currentStreak = DeedlerStreak::query()->where("deedler_id", "=", $doneDeedle->deedler_id)->orderBy("updated_at", "desc")->first();
        $currentStreak->days_count = $currentStreak->days_count + 1;
        $currentStreak->save();
    }
}