<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_kanji')->after('name');
            $table->string('name_kana')->nullable()->after('name_kanji');
            $table->foreignId('company_id')->nullable()->after('password')->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn(['name_kanji', 'name_kana', 'company_id']);
        });
    }
};