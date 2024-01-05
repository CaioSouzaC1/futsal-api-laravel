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
        Schema::table('teams', function (Blueprint $table) {
            $table->integer('points')->default(0)->change();
            $table->integer('goals')->default(0)->change();
            $table->integer('scored_goals')->default(0)->change();
            $table->integer('conceded_goals')->default(0)->change();
            $table->integer('wins')->default(0)->change();
            $table->integer('defeats')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
