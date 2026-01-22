<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_logs', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('std_number')->nullable();
            $table->string('coupon_code')->nullable();
            $table->float('discount_value')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            $table->string('ip')->nullable();
            $table->string('device')->nullable();
            $table->string('browser_info')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('coupon_logs');
    }
}
