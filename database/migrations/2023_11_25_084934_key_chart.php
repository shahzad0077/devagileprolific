<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KeyChart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_chart', function (Blueprint $table) {
            $table->id();
            $table->string('quarter_value')->nullable();
            $table->string('key_id')->nullable();
            $table->string('IndexCount')->nullable();
            $table->string('buisness_unit_id')->nullable();
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
        Schema::dropIfExists('key_chart');
    }
}
