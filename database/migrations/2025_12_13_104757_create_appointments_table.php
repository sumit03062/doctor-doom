<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            /* ======================
               USER & DOCTOR
            ====================== */
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('doctor_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            /* ======================
               PATIENT DETAILS
            ====================== */
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');

            $table->unsignedTinyInteger('age')->nullable();
            $table->string('gender')->nullable();

            $table->string('department');

            /* ======================
               APPOINTMENT SLOT
            ====================== */
            $table->date('appointment_date');
            $table->time('appointment_time');

            $table->text('message')->nullable();

            /* ======================
               PAYMENT (RAZORPAY)
            ====================== */
            $table->integer('amount')->nullable()->comment('Amount in paise');
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'refunded'
            ])->default('pending');

            /* ======================
               APPOINTMENT STATUS
            ====================== */
            $table->enum('status', [
                'pending',
                'upcoming',
                'completed',
                'canceled'
            ])->default('pending');

            $table->string('canceled_by')->nullable();

            /* ======================
               OPTIONAL INTEGRATIONS
            ====================== */
            $table->string('google_event_id')->nullable();

            $table->timestamps();

            /* ======================
               DOUBLE BOOKING PROTECTION
            ====================== */
            $table->unique(
                ['doctor_id', 'appointment_date', 'appointment_time'],
                'unique_doctor_date_time'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
