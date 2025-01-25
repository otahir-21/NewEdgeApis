<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('key_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->string('route');
            $table->string('icon');  // Save icon file paths
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('key_details');
    }
}