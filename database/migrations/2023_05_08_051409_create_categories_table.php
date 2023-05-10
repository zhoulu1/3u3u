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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0)->nullable()->comment('父级id');
            $table->string('name', 50)->nullable();
            $table->string('icon')->nullable();
            // $table->boolean('is_directory')->default(0)->nullable();
            // $table->unsignedInteger('level')->nullable();
            // $table->string('path')->nullable();
            $table->integer('order')->default(0)->nullable();
            $table->boolean('status')->default(1)->nullable();
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
        Schema::dropIfExists('categories');
    }
};
