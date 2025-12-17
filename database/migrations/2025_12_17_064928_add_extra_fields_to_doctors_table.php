<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->text('medals')->nullable()->after('about');
            $table->string('clinic_name')->nullable()->after('medals');
            $table->text('clinic_address')->nullable()->after('clinic_name');
            $table->integer('fees')->nullable()->after('clinic_address');
            $table->string('profile_photo_path')->nullable()->after('fees'); // optional, if storing photo
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['medals', 'clinic_name', 'clinic_address', 'fees', 'profile_photo_path']);
        });
    }
};
