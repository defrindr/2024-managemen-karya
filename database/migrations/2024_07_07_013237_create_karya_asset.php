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
        Schema::create('karya_asset', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karya_id')->references('id')->on('karyas');
            $table->enum('tipe', ['thumbnail', 'kegiatan', 'poster', 'peserta']);
            $table->string('file');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karya_asset');
    }
};
