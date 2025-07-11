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
        Schema::create('related_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('route');
            $table->string('featured_img');
            $table->string('price');
            $table->string('zone');
            $table->foreignId('developer_id')->constrained('developers');
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
        Schema::dropIfExists('related_projects');
    }
};
