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
        Schema::create('logo_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('logo_utama')->nullable();
            $table->string('logo_email')->nullable();
            $table->string('logo_favicon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_sekolahs');
    }
};
