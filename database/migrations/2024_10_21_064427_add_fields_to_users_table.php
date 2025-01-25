<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable(); // Add first_name column
            $table->string('last_name')->nullable();  // Add last_name column
            $table->string('mobile')->nullable();     // Add mobile column
            // You can add more columns here if necessary
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name'); // Remove first_name column
            $table->dropColumn('last_name');  // Remove last_name column
            $table->dropColumn('mobile');     // Remove mobile column
            // Drop more columns if necessary
        });
    }
}