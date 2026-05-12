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
        Schema::table('students', function (Blueprint $table) {
            $table->string('prodi')->after('email')->default('Informatika');
            $table->integer('angkatan')->after('prodi')->default(2023);
            $table->boolean('is_graduated')->after('angkatan')->default(false);
            $table->string('gender')->after('is_graduated')->default('Laki-laki');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['prodi', 'angkatan', 'is_graduated', 'gender']);
        });
    }
};
