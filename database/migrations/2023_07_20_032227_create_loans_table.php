<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_pinjam');
			$table->foreignId('anggota_id')->constrained('users')->restrictOnUpdate()->cascadeOnDelete();
			$table->foreignId('barang_id')->constrained('kop_products')->restrictOnUpdate()->cascadeOnDelete();
			$table->integer('lama_angsuran');
			$table->integer('jumlah');
			$table->float('bunga')->nullable();
			$table->integer('biaya_adm')->nullable();
			$table->enum('lunas', ['Belum', 'Lunas']);
			$table->enum('dk', ['D', 'K'])->nullable()->default('K');
			$table->foreignId('kas_id')->constrained('cash_types')->restrictOnUpdate()->cascadeOnDelete();
			$table->foreignId('jns_trans')->constrained('account_types')->restrictOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
};
