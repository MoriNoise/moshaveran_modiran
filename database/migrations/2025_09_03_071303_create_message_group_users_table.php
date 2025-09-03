<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('message_group_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('message_groups')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['group_id', 'user_id']); // prevent duplicate entries
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_group_users');
    }

};
