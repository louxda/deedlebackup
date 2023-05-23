<?php

namespace App\Http\Controllers\Api;

use App\Facades\DeedlerFacade;
use App\Models\Deedler;
use App\Models\DeedlerChallenge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DeedleCompleted
{
    public function __invoke(Request $request)
    {
        /** @var Deedler $deedler */
        $deedler = DeedlerFacade::getDeedler();

        $deedleId = $request->input("deedle_id");
        $created = DeedlerChallenge::query()->create([
            "deedler_id"   => $deedler->id,
            "challenge_id" => $deedleId,
        ]);
        if(!$created instanceof DeedlerChallenge){
            return new JsonResponse([
                "status"=>false,
                "message"=>"Couldn't complete deedle. Try again!"
            ]);
        }

        return new JsonResponse([
            "status"=>true,
            "message"=>"Deedle Completed!"
        ]);
    }
}