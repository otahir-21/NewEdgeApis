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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('route')->unique();
            $table->string('featured_img')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('range')->nullable();
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('developer_id');
            $table->unsignedBigInteger('property_type_id');
            $table->integer('bath')->nullable();
            $table->integer('bedroom')->nullable();
            $table->integer('area')->nullable();
            $table->string('rera_no')->nullable();
            $table->longText('description')->nullable();
            $table->string('video_url')->nullable();
            $table->json('slider_image')->nullable();
            $table->json('gallery_image')->nullable();
            $table->json('key_details')->nullable(); // Array of IDs
            $table->json('amenities')->nullable();   // Array of IDs
            $table->string('project_status')->nullable();
            $table->string('preleased_location')->nullable();
            $table->string('farmhouse_location')->nullable();
            $table->json('seo')->nullable();
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
        Schema::dropIfExists('projects');
    }
};