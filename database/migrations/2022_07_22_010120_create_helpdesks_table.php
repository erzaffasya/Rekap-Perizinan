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
        Schema::create('helpdesk', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('no_hp')->nullable();
            $table->foreignId("kategori_helpdesk_id")->constrained("kategori_helpdesk")->onUpdate("cascade")->nullable();
            $table->text('keterangan')->nullable();
            $table->text('ttd')->nullable();
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
        Schema::dropIfExists('helpdesk');
    }
};
