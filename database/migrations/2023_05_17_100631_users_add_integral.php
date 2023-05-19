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
        Schema::table('users', function (Blueprint $table) {
            $table->float('integral')->default(0)->nullable()->after('gender');
            $table->integer('user_id')->default(0)->nullable()->after('id');
            $table->integer('referrals')->default(0)->nullable()->after('integral')->comment('推荐人数');
            $table->decimal('total', 10, 2)->default(0)->nullable()->after('referrals');// 总收益
            $table->decimal('balance', 10, 2)->default(0)->nullable()->after('total');
            $table->string('promo_code')->nullable()->after('balance'); // 推广码
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('integral');
            $table->dropColumn('user_id');
            $table->dropColumn('referrals');
            $table->dropColumn('total');
            $table->dropColumn('balance');
            $table->dropColumn('promo_code');
        });
    }
};
