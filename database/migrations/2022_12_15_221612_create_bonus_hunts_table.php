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
        Schema::create('bonus_hunts', function (Blueprint $table) {
            $table->id(); // bonus ıd
            $table->string('bonus_name');  // balance
            $table->string('bonus_name_slug');  // balance
            $table->string('start_balance');  // balance
            $table->string('finish_balance')->nullable();  // toplam
            $table->string('games_avg')->nullable();  // avarage
            $table->string('total_game');  // balance
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
        Schema::dropIfExists('bonus_hunts');
    }
};
