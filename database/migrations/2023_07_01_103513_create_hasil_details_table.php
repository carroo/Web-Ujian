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
        Schema::create('hasil_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hasil_id')->nullable();
            $table->foreign('hasil_id')->references('id')->on('hasil')->onDelete('cascade');
            $table->unsignedBigInteger('soal_id')->nullable();
            $table->foreign('soal_id')->references('id')->on('soal')->onDelete('cascade');
            $table->string('jawaban')->nullable();
            $table->integer('nilai')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_details');
    }
};
