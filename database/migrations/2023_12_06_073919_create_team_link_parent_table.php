<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamLinkParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_link_parent', function (Blueprint $table) {
            $table->id('id');
            $table->string('key_id')->nullable();
            $table->string('link_team_id')->nullable();
            $table->string('link_obj_id')->nullable();
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
        Schema::dropIfExists('team_link_parent');
    }
}
