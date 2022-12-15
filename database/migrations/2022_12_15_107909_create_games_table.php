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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->string('slot_name')->unique();  // oyun adı
            $table->string('slot_name_slug');  // oyun adı
            $table->string('slot_picture')->nullable();  // oyun adı
            $table->string('slot_rtp')->nullable();  // slot_rtp
            $table->string('slot_volatility')->nullable();  // slot_volatility
            $table->timestamps();
            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
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
        Schema::dropIfExists('games');
    }
};
