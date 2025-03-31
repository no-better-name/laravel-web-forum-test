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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')
                  ->nullable()
                  ->comment('Table self reference enabling column --- comments may be replies to other comments')
                  ->constrained('comments', 'id')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->text('body');
            $table->timestamp('created_at');
            $table->bigInteger('upvotes');
            $table->bigInteger('downvotes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
