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
        Schema::create('site_info', function (Blueprint $table) {
            $table->id();
            $table->json('about'); // Store about as a JSON
            $table->json('counts'); // Store counts as a JSON
            $table->json('mission'); // Store mission as a JSON
            $table->json('vision'); // Store vision as a JSON
            $table->json('founder'); // Store founder as a JSON
            $table->json('team'); // Store team as a JSON
            $table->json('seo'); // Store SEO as a JSON
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
        Schema::dropIfExists('site_info');
    }
};