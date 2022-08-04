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
        Schema::create('tb_data_kesehatan', function (Blueprint $table) {
            $table->id();            
            $table->string('nama_pemohon')->nullable();
            $table->string('alamat_pemohon')->nullable();
            $table->string('tempat_kerja')->nullable();
            $table->string('nomor_str')->nullable();
            $table->date('izin_terbit')->nullable();
            $table->date('masa_berlaku_akhir')->nullable();
            $table->string('praktik_ke')->nullable();
            $table->string('alamat_praktik')->nullable();
            $table->foreignId("seksi_id")->nullable()->constrained("tb_seksi")->onUpdate("cascade");
            $table->string('jenis_izin')->nullable();
            $table->string('jenis_permohonan')->nullable();
            $table->string('lokasi_izin')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('jenis_kelamin',['L','P'])->nullable();
            $table->string('untuk_praktik')->nullable();
            $table->string('kategori_praktik')->nullable();
            $table->string('spesialis')->nullable();
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
        Schema::dropIfExists('tb_data');
    }
};
