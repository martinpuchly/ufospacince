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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('key');
            $table->string('main_name');
            $table->string('route');
            $table->boolean('link_in_admin_menu')->default(0);
        });

        Schema::create('permission_user', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');;
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');;
            $table->timestamps();
        });


        Schema::create('group_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');;
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');;
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
        Schema::dropIfExists('permission_user');
        Schema::dropIfExists('group_permission');
        Schema::dropIfExists('permissions');
    }
};
