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
        Schema::create('project_priorities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->unique('project_id');
            $table->unsignedBigInteger('time_span_id');
            $table->unsignedBigInteger('money_estimate_id');
            $table->unsignedBigInteger('manpower_id');
            $table->unsignedBigInteger('material_feasibility_id');
            $table->timestamps();
            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
            $table->foreign('time_span_id')
                ->references('id')
                ->on('time_spans');
            $table->foreign('money_estimate_id')
                ->references('id')
                ->on('money_estimates');
            $table->foreign('manpower_id')
                ->references('id')
                ->on('manpowers');
            $table->foreign('material_feasibility_id')
                ->references('id')
                ->on('material_feasibilities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_priorities');
    }
};
