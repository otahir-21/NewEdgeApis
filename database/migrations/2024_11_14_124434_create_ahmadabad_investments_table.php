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
        Schema::create('ahmadabad_investments', function (Blueprint $table) {
            $table->id();
            $table->string('intro_title');
            $table->text('intro_description');
            $table->string('intro_featured_img');
            $table->json('benefits');
            $table->string('why_invest_title');
            $table->text('why_invest_description');
            $table->string('why_invest_featured_img');
            $table->json('benefits2');
            $table->string('location1_title');
            $table->string('location1_link');
            $table->string('location1_featured_img');
            $table->string('location2_title');
            $table->string('location2_link');
            $table->string('location2_featured_img');
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
        Schema::dropIfExists('ahmadabad_investments');
    }
};