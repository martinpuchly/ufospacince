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
            $table->date('birst_date')->nullable();
            $table->integer('shirt_number')->nullable();
            $table->string('photo')->nullable();
            $table->text('about')->nullable();

            $table->boolean('show_first_name')->default(0);
            $table->boolean('show_last_name')->default(0);
            $table->boolean('show_nickname')->default(0);
            $table->boolean('show_birst_date')->default(0);
            $table->boolean('show_shirt_number')->default(0);
            $table->boolean('show_photo')->default(0);
            $table->boolean('show_about')->default(0);
            $table->boolean('show_user')->default(0);

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
            Schema::dropIfExists('player_user_id_foreign');

        });
    }
};
