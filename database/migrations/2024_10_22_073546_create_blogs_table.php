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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('posted_by')->nullable();
            $table->string('title');
            $table->string('route');
            $table->text('long_description');
            $table->string('feature_image')->nullable();
            $table->string('inner_page_img')->nullable();
            $table->json('seo')->nullable(); // Store SEO data as JSON
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
        Schema::dropIfExists('blogs');
    }
};