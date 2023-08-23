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
        Schema::create('cash_types', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
			$table->enum('aktif', ['Y', 'T']);
			$table->enum('tmpl_simpan', ['Y', 'T'])->nullable();
			$table->enum('tmpl_penarikan', ['Y', 'T'])->nullable();
			$table->enum('tmpl_pinjaman', ['Y', 'T'])->nullable();
			$table->enum('tmpl_bayar', ['Y', 'T'])->nullable();
			$table->enum('tmpl_pemasukan', ['Y', 'T'])->nullable();
			$table->enum('tmpl_pengeluaran', ['Y', 'T'])->nullable();
			$table->enum('tmpl_transfer', ['Y', 'T'])->nullable();
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
        Schema::dropIfExists('cash_types');
    }
};
