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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('tags')->nullable();
            $table->longText('intro');
            $table->longText('body')->nullable();
            $table->integer('views')->nullable()->default(0);
            $table->integer('likes')->nullable()->default(0);
            $table->boolean('published')->nullable()->default(0);
            $table->dateTime('published_at');
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts', function (Blueprint $table) {
            $table->dropIfExists('posts_user_id_foreign');
            $table->dropSoftDeletes();
        });        
    }
};
