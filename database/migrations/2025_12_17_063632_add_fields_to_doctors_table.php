<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
         
            // ADD NAME if missing
            if (!Schema::hasColumn('doctors', 'name')) {
                $table->string('name')->after('id');
            }

            if (!Schema::hasColumn('doctors', 'email')) {
                $table->string('email')->unique()->after('name');
            }

            if (!Schema::hasColumn('doctors', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }

            if (!Schema::hasColumn('doctors', 'specialization')) {
                $table->string('specialization')->after('phone');
            }

            if (!Schema::hasColumn('doctors', 'experience')) {
                $table->integer('experience')->nullable()->after('specialization');
            }

            if (!Schema::hasColumn('doctors', 'gender')) {
                $table->enum('gender', ['male', 'female', 'other'])
                    ->nullable()
                    ->after('experience');
            }

            if (!Schema::hasColumn('doctors', 'bio')) {
                $table->text('bio')->nullable()->after('gender');
            }

            if (!Schema::hasColumn('doctors', 'profile_photo')) {
                $table->string('profile_photo')->nullable()->after('bio');
            }

            if (!Schema::hasColumn('doctors', 'is_active')) {
                $table->boolean('is_active')
                    ->default(true)
                    ->after('profile_photo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {

            $table->dropColumn([
                'name',
                'email',
                'phone',
                'specialization',
                'experience',
                'gender',
                'bio',
                'profile_photo',
                'is_active',
            ]);
        });
    }
};
