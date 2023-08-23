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
        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_catat');
			$table->integer('jumlah');
			$table->string('keterangan', 255)->nullable();
			$table->enum('akun', ['Pemasukan', 'Pengeluaran', 'Transfer']);
			$table->foreignId('dari_kas_id')->nullable()->constrained('cash_types')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('untuk_kas_id')->nullable()->constrained('cash_types')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('jns_trans')->nullable()->constrained('account_types')->cascadeOnUpdate()->cascadeOnDelete();
			$table->enum('dk', ['D', 'K'])->nullable();
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
        Schema::dropIfExists('cash_transactions');
    }
};
