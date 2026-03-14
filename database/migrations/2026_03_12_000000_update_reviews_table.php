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
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')
                ->nullable(false)
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('modules_id')->after('id')
                ->nullable()
                ->constrained('modules')
                ->onDelete('set null');

            $table->tinyInteger('stars')->after('id')
                ->nullable(false)
                ->unsigned();

            $table->string('status')->after('id')->default('new')->comment('new, approved, rejected');

            $table->dropColumn(['name', 'course']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['modules_id']);
            $table->dropColumn(['user_id', 'stars', 'modules_id']);

            $table->string('name')->nullable(false);
            $table->string('course')->nullable(false);
        });
    }
};
