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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->integer('type')->default(1);
            $table->integer('place')->default(1);
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('player_training', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->nullable()->constrained('players')->onDelete('set null');
            $table->foreignId('training_id')->nullable()->constrained('trainings')->onDelete('set null');
            $table->integer('p_status')->nullable()->default(0);
            $table->integer('a_status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_training', function (Blueprint $table) {
            $table->dropIfExists('player_training_player_id_foreign');
            $table->dropIfExists('player_training_training_id_foreign');

        });
        Schema::dropIfExists('trainings');

    }
};
