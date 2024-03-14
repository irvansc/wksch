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
        Schema::create('idses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('nss');
            $table->string('akreditasi');
            $table->string('status');
            $table->string('nokep');
            $table->string('luas_area');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idses');
    }
};
