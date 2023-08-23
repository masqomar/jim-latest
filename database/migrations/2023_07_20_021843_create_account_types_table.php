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
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('kd_aktiva', 255);
			$table->string('jns_trans', 255);
			$table->enum('akun', ['Aktiva', 'Pasiva'])->nullable();
			$table->enum('laba_rugi', ['', 'PENDAPATAN', 'BIAYA'])->nullable();
			$table->enum('pemasukan', ['Y', 'N'])->nullable();
			$table->enum('pengeluaran', ['Y', 'N'])->nullable();
			$table->enum('aktif', ['Y', 'N']);
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
        Schema::dropIfExists('account_types');
    }
};
