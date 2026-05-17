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
        Schema::create('aduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('zona_id')->constrained('zonas')->onDelete('cascade');
            $table->string('gambar');
            $table->text('keterangan');
            $table->enum('status', ['diadukan', 'diproses', 'perbaikan selesai'])->default('diadukan');
            $table->string('bukti_selesai')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aduans');
    }
};
