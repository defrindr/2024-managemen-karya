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
        Schema::create('karya_kompetisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karya_id')->references('id')->on('karyas')->onDelete('cascade');
            $table->foreignId('jenis_kompetisi')->references('id')->on('jenis_kompetisi')->onDelete('cascade');
            $table->foreignId('tingkat_kompetisi')->references('id')->on('tingkat_kompetisi')->onDelete('cascade');
            $table->string('tempat_kompetisi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->integer('jumlah_peserta');
            $table->string('penghargaan');

            $table->longText('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karya_kompetisi');
    }
};
