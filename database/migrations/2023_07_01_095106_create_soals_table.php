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
        Schema::create('soal', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('guru_id')->nullable();
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->foreign('mapel_id')->references('id')->on('mapel')->onDelete('cascade');
            $table->integer('bobot')->default(1);
            $table->string('gambar_soal')->nullable();
            $table->text('soal')->nullable();
            $table->integer('tipe')->default(0);
            $table->text('opsi_a')->nullable();
            $table->text('opsi_b')->nullable();
            $table->text('opsi_c')->nullable();
            $table->text('opsi_d')->nullable();
            $table->text('opsi_e')->nullable();
            $table->string('gambar_a')->nullable();
            $table->string('gambar_b')->nullable();
            $table->string('gambar_c')->nullable();
            $table->string('gambar_d')->nullable();
            $table->string('gambar_e')->nullable();
            $table->string('jawaban',5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
