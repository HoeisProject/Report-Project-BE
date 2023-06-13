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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->string('username', 50);
            $table->string('nickname', 50);
            $table->string('email', 50)->unique();
            $table->string('nik', 17)->nullable();
            $table->string('phone_number', 20);
            $table->unsignedTinyInteger('status');
            $table->string('password', 100);
            $table->string('user_image', 255)->nullable();
            $table->string('ktp_image', 255)->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
