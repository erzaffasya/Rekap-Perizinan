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
        Schema::create('tb_data_pendidikan', function (Blueprint $table) {
            $table->id();                  
            $table->date('tanggal_terbit')->nullable();
            $table->string('nomor_izin')->nullable();      
            $table->string('nama_sekolah')->nullable(); 
            $table->string('NIB')->nullable(); 
            $table->text('alamat')->nullable();
            $table->string('nama_yayasan')->nullable();            
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
        Schema::dropIfExists('tb_data_pendidikan');
    }
};
