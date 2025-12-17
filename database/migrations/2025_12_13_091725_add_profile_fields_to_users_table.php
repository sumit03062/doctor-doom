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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age')->nullable()->after('email');          // Age as integer, optional
            $table->string('gender')->nullable()->after('age');          // Male/Female/Other
            $table->string('phone')->nullable()->unique()->after('gender'); // Phone, unique & optional
            // If you already have profile_photo_path from Jetstream/Breeze, it's probably there already
            // $table->string('profile_photo_path')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['age', 'gender', 'phone']);
            // $table->dropColumn('profile_photo_path'); // if you added it above
        });
    }
};