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
        Schema::create('tb_data_pertahanan', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->string('kecamatan')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tujuan_opd')->nullable();
            $table->text('keterangan')->nullable();            
            $table->foreignId("seksi_id")->nullable()->constrained("tb_seksi")->onUpdate("cascade");
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
        Schema::dropIfExists('tb_data_pertahanan');
    }
};
