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
        Schema::create('karyas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->string('judul');
            $table->string('gambar');
            $table->string('deskripsi');
            $table->string('link_youtube');

            $table->foreignId('created_by')->references('id')->on('users');
            $table->foreignId('approved_by')->nullable()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyas');
    }
};