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
        Schema::table('users', function (Blueprint $table) {
            $table->comment('Forum user data');
            $table->string('name', 32)->unique()->change();
            $table->boolean('is_moderator')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->comment('');
            $table->string('name')->change();
            $table->dropColumn('is_moderator');
            $table->dropUnique('users_name_unique');
        });
    }
};
