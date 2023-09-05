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
        Schema::create('pulsa_lists', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('kategori');
            $table->string('sku')->unique();
            $table->string('nama_produk');
            $table->integer('harga');
            $table->integer('margin');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pulsa_lists');
    }
};
