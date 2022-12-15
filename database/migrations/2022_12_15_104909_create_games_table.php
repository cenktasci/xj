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
            $table->string('provider_id');   // saglayıcı
            $table->string('slot_name')->unique();  // oyun adı
            $table->string('slot_name_slug');  // oyun adı
            $table->string('slot_rtp');  // slot_rtp
            $table->string('slot_volatility');  // slot_volatility
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
        Schema::dropIfExists('games');
    }
};
