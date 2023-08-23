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
        Schema::create('loan_details', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_bayar');
			$table->foreignId('pinjam_id')->constrained('loans')->restrictOnUpdate()->cascadeOnDelete();
			$table->integer('angsuran_ke');
			$table->integer('jumlah_bayar');
			$table->integer('denda_rp')->nullable();
			$table->integer('terlambat')->nullable();
			$table->enum('ket_bayar', ['Angsuran', 'Pelunasan', 'Bayar Denda']);
			$table->enum('dk', ['D', 'K'])->nullable()->default('D');
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
        Schema::dropIfExists('loan_details');
    }
};
