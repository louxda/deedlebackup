<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deedler_challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Deedler::class,"deedler_id");
            $table->foreignIdFor(\App\Models\DailyChallenge::class,"challenge_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deedler_challenges');
    }
};
