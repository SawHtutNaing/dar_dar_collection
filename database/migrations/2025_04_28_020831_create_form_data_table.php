<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_name_id')->constrained('form_names')->onDelete('cascade');
            $table->foreignId('code_id')->constrained('codes')->onDelete('cascade');
            $table->string('customer_name');
            $table->integer('quantity');
            $table->text('remark')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('status')->default(1)->nullable(); // 1 = order_confirm, 0 = cancel
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_data');
    }
};
