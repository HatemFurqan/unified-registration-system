<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('new_student_id')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->string('email');
            $table->string('form_type')->default('regular'); // المفتاح الرئيسي للتمييز
            $table->string('payment_method');
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('reference_number');
            $table->string('response_code')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->decimal('discount_value', 10, 2)->default(0.00);
            $table->string('coupon_code')->nullable();
            $table->string('favorite_time')->nullable();
            $table->unsignedBigInteger('custom_price_id')->nullable();
            $table->string('discount_reason_image')->nullable();
            
            // حقول خاصة بالطلاب الجدد
            $table->string('arabic_level')->nullable();
            $table->string('quran_level')->nullable();
            $table->text('national_address')->nullable();
            $table->string('branch')->nullable();
            
            // حقول الحوالة البنكية
            $table->string('money_transfer_image_path')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_owner')->nullable();
            $table->date('transfer_date')->nullable();
            $table->string('bank_reference_number')->nullable();
            
            // حقول PayPal
            $table->decimal('paypal_fee', 10, 2)->nullable();
            
            // حقول خاصة بالورد اليومي
            $table->unsignedBigInteger('course_id')->nullable();
            
            // حقول خاصة بيوم التأسيس
            $table->decimal('last_payment', 10, 2)->nullable();
            $table->string('student_referral')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('form_type');
            $table->index('student_id');
            $table->index('new_student_id');
            $table->index('payment_status');
            $table->index('reference_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribes');
    }
}
