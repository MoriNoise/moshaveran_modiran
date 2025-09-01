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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('full_name', 200)->nullable();
            $table->string('phone', 20)->unique()->nullable(); // 📞 شماره تلفن
            $table->string('email', 150)->unique()->nullable(); // 📧 ایمیل
            $table->enum('gender', ['male','female','other'])->nullable();
            $table->date('birthday')->nullable();
            $table->string('organization', 150)->nullable();
            $table->boolean('is_active')->default(true); // فعال / غیرفعال
            $table->json('extra')->nullable(); // for vcf extra data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
