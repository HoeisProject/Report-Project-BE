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
            $table->unsignedBigInteger('report_statuses_id');
            $table->string('title', 100);
            $table->string('description', 1000);
            $table->string('position', 30);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('report_statuses_id')
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
