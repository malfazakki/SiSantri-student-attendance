<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nis', 20)->unique();
            $table->foreignId('angkatan_id')->constrained();
            $table->foreignId('jurusan_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('santris');
    }
};
