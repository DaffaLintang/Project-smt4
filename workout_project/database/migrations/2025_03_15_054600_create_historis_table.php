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
        Schema::create('historis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_result');
            $table->integer('durasi');
            $table->integer('repetisi');
            $table->string('kesulitan');
            $table->text('catatan');
            $table->timestamps();

            $table->foreign('id_user')->references('user')->on('id')->onDelete('cascade');
            $table->foreign('id_result')->references('result')->on('id')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historis');
    }
};
