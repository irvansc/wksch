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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nis');
            $table->enum('jenkel', ['L', 'P'])->default('L');
            $table->string('tgl_lahir');
            $table->string('thn_masuk');
            $table->string('thn_lulus');
            $table->text('alamat');
            $table->string('email');
            $table->string('telp');
            $table->string('img')->nullable();
            $table->boolean('isActive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
