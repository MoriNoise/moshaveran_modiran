<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('message_queue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('message_batches')->onDelete('cascade');
            $table->foreignId('user_contact_id')->constrained('user_contacts')->onDelete('cascade');
            $table->text('message_content');
            $table->enum('status', ['pending','sent','failed','delivered','read'])->default('pending');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_queue');
    }
};
