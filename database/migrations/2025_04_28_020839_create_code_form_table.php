<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('code_form', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('form_names')->onDelete('cascade');
            $table->foreignId('code_id')->constrained('codes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('code_form');
    }
};
