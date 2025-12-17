<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Patient
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // Doctor
            $table->foreignId('doctor_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('full_name');
            $table->string('email');
            $table->string('phone');

            $table->integer('age')->nullable();
            $table->string('gender')->nullable();

            $table->string('department');

            $table->date('appointment_date');
            $table->time('appointment_time');

            $table->text('message')->nullable();

            $table->enum('status', ['upcoming', 'completed', 'canceled'])->default('upcoming');
            $table->string('canceled_by')->nullable();

            $table->string('google_event_id')->nullable();

            $table->timestamps();

            // Prevent double booking per doctor
            $table->unique(
                ['doctor_id', 'appointment_date', 'appointment_time'],
                'unique_doctor_date_time'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
