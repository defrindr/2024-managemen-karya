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
        Schema::create('karya_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karya_id')->references('id')->on('karyas')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->references('id')->on('mata_kuliah')->onDelete('cascade');
            $table->longText('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karya_tugas');
    }
};
