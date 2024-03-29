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
        Schema::create('kepala_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nip')->nullable();
            $table->string('akreditasi')->nullable();
            $table->text('serint')->nullable();
            $table->text('desc')->nullable();
            $table->string('img')->nullable();
            $table->text('video_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepala_sekolahs');
    }
};
