<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug');
            $table->string('nickname')->nullable();
            $table->integer('shirt_number')->nullable();
            $table->string('photo')->nullable();
            $table->text('about')->nullable();
            $table->integer('sex')->nullable()->default(0);          // 0-nevyplnené | 1-žena | 2-muž | 3-ešte som sa nerozhodol
            $table->date('birth_date')->nullable();
            //$table->foreignId('team_id')->nullable()->constrained('teams')->onDelete('set null');;
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');;


            $table->integer('show_profile')->nullable()->default(0);        // 0-nikto | 1-hráci | 2-prihlásený | 3-všetci
            $table->integer('show_birth_date')->nullable()->default(0);     // 0-nikto | 1-hráci | 2-prihlásený | 3-všetci
            $table->integer('show_photo')->nullable()->default(0);          // 0-nikto | 1-hráci | 2-prihlásený | 3-všetci

            $table->integer('status')->nullable()->default(0);              // 0-ziadost, 1-potvrdeny
            // $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
