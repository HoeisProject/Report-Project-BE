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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('report_status_id');
            $table->string('title');
            $table->string('description');
            $table->string('position');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('report_status_id')
                ->references('id')
                ->on('report_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
