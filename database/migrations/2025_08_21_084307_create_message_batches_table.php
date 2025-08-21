<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('message_batches', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('platform_id')->constrained('platforms')->onDelete('cascade');
            $table->foreignId('template_group_id')->nullable()->constrained('template_groups')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_batches');
    }
};
