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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('intro_title');
            $table->text('intro_description');
            $table->string('intro_featured_img');

            $table->json('key_details');
            $table->json('expert_tips');
            $table->json('tips');
            $table->json('factors');
            $table->json('phases');

            $table->string('why_invest_title');
            $table->text('why_invest_description');
            $table->string('why_invest_featured_img');

            $table->json('offerings');
            $table->string('opportunity1_title');
            $table->string('opportunity1_featured_img');
            $table->string('opportunity2_title');
            $table->string('opportunity2_featured_img');

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
        Schema::dropIfExists('investments');
    }
};