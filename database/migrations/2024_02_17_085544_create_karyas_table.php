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
            $table->foreignId('team_id')->nullable()->references('id')->on('teams');
            $table->integer('is_personal')->default(0);
            $table->string('judul');
            // tambahkan lagi
            $table->string('youtube_url');
            $table->string('project_url');
            $table->string('thumbnail');

            $table->integer('views')->default(0);

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
