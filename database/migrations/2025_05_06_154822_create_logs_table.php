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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_data_id');
            $table->string('code');
            $table->string('customer_name');
            $table->integer('quantity');
            $table->text('remark')->nullable();
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('status')->default(1)->nullable(); // 1 = order_confirm, 0 = cance
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
