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
        if(Schema::hasTable("daily_challenges")){
            Schema::table('daily_challenges', function (Blueprint $table) {
               $table->integer("challenge_number")->nullable();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable("daily_challenges")){
            Schema::table('daily_challenges', function (Blueprint $table) {
               $table->removeColumn("challenge_number");
            });
        }
    }
};
