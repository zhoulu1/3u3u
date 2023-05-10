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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('recycler_id')->nullable();// 回收员ID
            $table->integer('category_id')->nullable();
            $table->unsignedFloat('weight')->default(0)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->string('weight_desc')->nullable();
            $table->integer('appointment_time')->nullable();
            $table->string('remark')->nullable();
            $table->text('address')->nullable();
            $table->unsignedFloat('integral')->default(0)->nullable();
            $table->string('status')->default('pending')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
