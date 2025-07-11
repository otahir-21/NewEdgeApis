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
            $table->date('date');
            $table->string('posted_by')->nullable();
            $table->string('title');
            $table->string('route');
            $table->longText('long_description');
            $table->string('feature_image');
            $table->string('inner_page_img');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->json('schema_markup')->nullable();
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