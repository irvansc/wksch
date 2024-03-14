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
        Schema::create('slider_prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->text('desc')->nullable();
            $table->string('action_title')->nullable();
            $table->text('action')->nullable();
            $table->integer('ordering')->default(10000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_prestasis');
    }
};
