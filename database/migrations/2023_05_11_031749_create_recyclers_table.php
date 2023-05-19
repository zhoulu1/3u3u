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
        Schema::create('recyclers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name', 50)->nullable();
            $table->string('mobile', 11)->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('status', 20)->default('applying')->nullable();
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
        Schema::dropIfExists('recyclers');
    }
};
