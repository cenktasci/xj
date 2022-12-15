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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('provider_name')->unique();  // oyun adı
            $table->string('provider_name_slug')->unique();  // oyun adı
            $table->string('provider_logo')->nullable();  // oyun logo
            $table->string('provider_picture')->nullable();  // oyun logo
            $table->string('provider_explanation')->nullable();  // oyun acıklaması
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
        Schema::dropIfExists('providers');
    }
};
