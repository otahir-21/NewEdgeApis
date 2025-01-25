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
        Schema::create('key_detail_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // Ensure the project_id references the projects table
            $table->foreignId('key_detail_id')->constrained()->onDelete('cascade'); // Ensure the key_detail_id references the key_details table
            $table->timestamps(); // Optional: if you want to track when these records were created/updated
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('key_detail_project');
    }
};