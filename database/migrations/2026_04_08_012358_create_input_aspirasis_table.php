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
        Schema::create('input_aspirasi', function (Blueprint $table) {
            $table->integer('id_pelaporan')->primary();
            $table->integer('nis');
            $table->foreignId('id_kategori')->constrained('kategori', 'id_kategori');
            $table->string('lokasi', 50);
            $table->string('ket', 50);
            $table->foreign('nis')->references('nis')->on('siswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_aspirasis');
    }
};
