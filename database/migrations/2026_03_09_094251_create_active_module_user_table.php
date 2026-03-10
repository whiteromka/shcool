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
        Schema::create('active_module_to_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('active_module_id')->constrained()->onDelete('cascade');
            $table->timestamp('joined_at')->nullable()->comment('Дата присоединения');
            $table->timestamps();

            // Уникальная пара: пользователь может быть в активном модуле один раз
            $table->unique(['user_id', 'active_module_id'], 'unique_user_active_module');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_module_to_user');
    }
};
