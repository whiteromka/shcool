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
        Schema::create('business_requests', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable(false);
            $table->string('name')->nullable(false)->comment('ФИО');
            $table->string('email')->nullable(false);
            $table->string('phone')->nullable();
            $table->string('telegram')->nullable();
            $table->string('city')->nullable();
            $table->string('industry')->nullable();
            $table->text('message')->nullable(false);
            $table->timestamp('deadline')->nullable();
            $table->string('budget')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_requests');
    }
};
