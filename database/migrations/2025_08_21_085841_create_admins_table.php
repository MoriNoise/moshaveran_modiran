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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('username', 100)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_super')->default(false); // دسترسی کامل
            $table->boolean('is_active')->default(true); // فعال / غیرفعال
            $table->string('avatar')->nullable(); // عکس پروفایل
            $table->timestamps();
        });
    }

        /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
