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
        Schema::create('dholera_investments', function (Blueprint $table) {
            $table->id();
            $table->string('intro_title');
            $table->text('intro_description');
            $table->string('intro_featured_img');

            // Location 1
            $table->string('location1_title');
            $table->string('location1_link');
            $table->string('location1_featured_img');

            // Location 2
            $table->string('location2_title');
            $table->string('location2_link');
            $table->string('location2_featured_img');

            // Advantages
            $table->json('advantages'); // store advantages as JSON

            // Industries
            $table->string('industries_title');
            $table->text('industries_description');

            // Plan
            $table->string('plan_title');
            $table->text('plan_description');
            $table->string('plan_featured_img');

            // Plan List
            $table->json('planList'); // store plan list as JSON

            // DMIC
            $table->string('dmic_title');
            $table->text('dmic_description');
            $table->string('dmic_featured_img');

            // DMIC List
            $table->json('dmicList'); // store DMIC list as JSON

            // Airport
            $table->string('airport_title');
            $table->text('airport_description');
            $table->string('airport_featured_img');

            // Advantage
            $table->string('advantage_title');
            $table->text('advantage_description');

            // Expectations
            $table->json('expectations'); // store expectations as JSON

            // Sectors
            $table->json('sectors'); // store sectors as JSON

            // Benefits
            $table->json('benefits'); // store benefits as JSON

            // Investors
            $table->json('investors'); // store investors as JSON

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
        Schema::dropIfExists('dholera_investments');
    }
};
