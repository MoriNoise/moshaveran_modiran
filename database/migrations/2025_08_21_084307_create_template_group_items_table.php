<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('template_group_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('template_groups')->onDelete('cascade');
            $table->foreignId('template_id')->constrained('message_templates')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template_group_items');
    }
};
