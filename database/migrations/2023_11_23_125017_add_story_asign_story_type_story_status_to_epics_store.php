<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoryAsignStoryTypeStoryStatusToEpicsStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('epics_stroy', function (Blueprint $table) {
            $table->string('story_assign');
            $table->string('story_type');
            $table->string('story_status');
            $table->string('StoryID');
            $table->string('VS_BU_ID');
            $table->string('R_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('epics_stroy', function (Blueprint $table) {
            $table->dropColumn('story_assign');
            $table->dropColumn('story_type');
            $table->dropColumn('story_status');
            $table->dropColumn('StoryID');
            $table->dropColumn('VS_BU_ID');
            $table->dropColumn('R_id');
        });
    }
}
