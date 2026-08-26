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
    Schema::create('bukus', function (Blueprint $table) {
        $table->id();
        $table->string('kode_buku');
        $table->string('judul');
        $table->string('pengarang');
        $table->string('penerbit');
        $table->integer('stok');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('bukus');
}
};