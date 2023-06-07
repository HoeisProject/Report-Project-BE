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
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('time_spans_id');
            $table->unsignedBigInteger('money_estimates_id');
            $table->unsignedBigInteger('manpowers_id');
            $table->unsignedBigInteger('material_feasibilities_id');
            $table->timestamps();
            // $table->foreign('project_id')
            //     ->references('id')
            //     ->on('projects');
            // $table->foreign('time_spans_id')
            //     ->references('id')
            //     ->on('time_spans');
            // $table->foreign('money_estimates_id')
            //     ->references('id')
            //     ->on('money_estimates');
            // $table->foreign('manpowers_id')
            //     ->references('id')
            //     ->on('manpowers');
            // $table->foreign('material_feasibilities_id')
            //     ->references('id')
            //     ->on('material_feasibilities');
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
