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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('no_ajuan');
			$table->string('ajuan_id', 255);
			$table->foreignId('anggota_id')->constrained('users')->restrictOnUpdate()->cascadeOnDelete();
			$table->dateTime('tgl_input');
			$table->string('jenis', 255);
			$table->integer('nominal');
			$table->integer('lama_ags');
			$table->string('keterangan', 255);
			$table->tinyInteger('status');
			$table->string('alasan', 255)->nullable();
			$table->date('tgl_cair')->nullable();
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
        Schema::dropIfExists('submissions');
    }
};
