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
        Schema::create('Results', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('desc');
            $table->string('type');
            $table->string('bodyPart');
            $table->string('equipment');
            $table->string('level');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Results');
    }
};
