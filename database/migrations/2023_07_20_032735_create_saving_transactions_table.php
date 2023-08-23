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
        Schema::create('saving_transactions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_transaksi');
			$table->foreignId('anggota_id')->constrained('users')->restrictOnUpdate()->cascadeOnDelete();
			$table->foreignId('jenis_id')->constrained('saving_types')->restrictOnUpdate()->cascadeOnDelete();
			$table->integer('jumlah');
            $table->string('keterangan')->nullable();
			$table->enum('akun', ['Setoran', 'Penarikan']);
			$table->enum('dk', ['D', 'K']);
			$table->foreignId('kas_id')->constrained('cash_types')->restrictOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('saving_transactions');
    }
};
