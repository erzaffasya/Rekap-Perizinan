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
        Schema::create('tb_seksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_seksi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->foreignId("sektor_id")->nullable()->constrained("tb_sektor")->onUpdate("cascade");
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
        Schema::dropIfExists('tb_seksi');
    }
};
