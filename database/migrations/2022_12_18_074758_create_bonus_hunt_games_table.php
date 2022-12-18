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
        Schema::create('bonus_hunt_games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bonus_hunts_id');
            $table->unsignedBigInteger('game_id');
            $table->string('bet');
            $table->string('multiplier')->nullable();
            $table->string('result')->nullable();
            $table->timestamps();

            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');

            $table->foreign('bonus_hunts_id')
                ->references('id')
                ->on('bonus_hunts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus_hunt_games');
    }
};
