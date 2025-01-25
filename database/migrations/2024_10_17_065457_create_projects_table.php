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
            $table->string('route');
            $table->string('featured_img');
            $table->decimal('price', 10, 2);
            $table->string('range');
            $table->foreignId('zone_id')->constrained()->onDelete('cascade');
            $table->foreignId('developer_id')->constrained()->onDelete('cascade');
            $table->integer('bath');
            $table->integer('bedroom');
            $table->string('area');
            $table->string('rera_no')->nullable();
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
            $table->foreignId('property_type_id')->constrained()->onDelete('cascade');
            $table->json('slider_image')->nullable();
            $table->json('gallery_image')->nullable();
            $table->json('key_details')->nullable(); // Assuming this will be an array of key detail IDs
            $table->json('amenities')->nullable(); // Assuming this will be an array of amenity IDs
            $table->json('seo')->nullable(); // For SEO details
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