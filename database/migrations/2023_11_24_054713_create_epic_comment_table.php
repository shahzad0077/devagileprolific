<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpicCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epic_comment', function (Blueprint $table) {
            $table->id('id');
            $table->string('epic_id')->nullable();
            $table->string('user_id');
            $table->text('comment')->nullable();
            $table->text('r_id')->nullable();
            $table->boolean('is_publish')->default(0);
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
        Schema::dropIfExists('epic_comment');
    }
}
