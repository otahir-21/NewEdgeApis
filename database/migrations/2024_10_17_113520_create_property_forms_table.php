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
    Schema::create('property_forms', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('company')->nullable();
        $table->string('phone');
        $table->string('city_name');
        $table->string('email');
        $table->string('property');
        $table->decimal('min_budget', 10, 2);
        $table->decimal('max_budget', 10, 2);
        $table->text('message')->nullable();
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
        Schema::dropIfExists('property_forms');
    }
};