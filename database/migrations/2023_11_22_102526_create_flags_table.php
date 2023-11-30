<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flags', function (Blueprint $table) {
            $table->id();
            $table->string('epic_id')->nullable();
            $table->string('flag_type')->nullable();
            $table->string('flag_assign')->nullable();
            $table->longtext('flag_title')->nullable();
            $table->string('flag_description')->nullable();
            $table->string('flag_status')->nullable();
            $table->string('flag_order')->nullable();
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
        Schema::dropIfExists('flags');
    }
}
