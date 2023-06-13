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
        Schema::create('time_spans', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('min');
            $table->unsignedTinyInteger('max');
            $table->unsignedSmallInteger('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_spans');
    }
};
