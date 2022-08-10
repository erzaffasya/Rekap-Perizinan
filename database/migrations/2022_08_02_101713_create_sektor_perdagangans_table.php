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
        Schema::create('tb_data_perdagangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(); 
            $table->string('alamat_kantor')->nullable(); 
            $table->string('lokasi_usaha')->nullable(); 
            $table->string('nib')->nullable(); 
            $table->string('status_penanaman_modal')->nullable(); 
            $table->string('kbli')->nullable(); 
            $table->date('tanggal')->nullable(); 
            $table->string('tujuan_opd')->nullable(); 
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
        Schema::dropIfExists('tb_data_perdagangan');
    }
};
