<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeyResultTypeInKeyResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('key_result', function (Blueprint $table) {
            $table->string('key_result_type')->nullable();  
            $table->string('key_unit')->nullable();
            $table->string('init_value')->nullable();
            $table->string('target_number')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('key_result', function (Blueprint $table) {
            $table->dropColumn('key_result_type');
            $table->dropColumn('key_unit');
            $table->dropColumn('init_value');
            $table->dropColumn('target_number');
        });
    }
}
