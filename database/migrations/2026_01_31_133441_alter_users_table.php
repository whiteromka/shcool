<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telegram_id')->nullable()->unique()->after('telegram');
            $table->boolean('from_tgbot_unknown')->nullable()->after('telegram_id')->comment('Пришел из Tgbot неопознан');
            $table->json('additional_data')->nullable()->after('remember_token')->comment('Дополнительные данные пользователя в JSON');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telegram_id');
            $table->dropColumn('from_tgbot_unknown');
            $table->dropColumn('additional_data');
        });
    }
};
