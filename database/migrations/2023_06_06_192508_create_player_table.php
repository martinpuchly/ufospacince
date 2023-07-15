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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug');
            $table->boolean('show_player')->default(1);

            $table->string('nickname')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('shirt_number')->nullable();
            $table->string('photo')->nullable();
            $table->text('about')->nullable();

            $table->integer('show_first_name')->nullable()->default(0);
            $table->integer('show_last_name')->nullable()->default(0);
            $table->integer('show_nickname')->nullable()->default(0);
            $table->integer('show_birth_date')->nullable()->default(0);
            $table->integer('show_age')->nullable()->default(0);
            $table->integer('show_shirt_number')->nullable()->default(0);
            $table->integer('show_photo')->nullable()->default(0);
            $table->integer('show_about')->nullable()->default(0);
            $table->integer('show_user')->nullable()->default(0);

            $table->boolean('active')->default(1);
            $table->softDeletes();

            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players', function (Blueprint $table) {
            $table->dropIfExists('player_user_id_foreign');
            $table->dropSoftDeletes();
        });
    }
};
