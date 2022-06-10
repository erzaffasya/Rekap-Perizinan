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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->foreignId("perizinan_id")->constrained("perizinan")->onDelete("cascade")->onUpdate("cascade");
            $table->integer('januari')->nullable();
            $table->integer('februari')->nullable();
            $table->integer('maret')->nullable();
            $table->integer('april')->nullable();
            $table->integer('mei')->nullable();
            $table->integer('juni')->nullable();
            $table->integer('juli')->nullable();
            $table->integer('agustus')->nullable();
            $table->integer('september')->nullable();
            $table->integer('oktober')->nullable();
            $table->integer('november')->nullable();
            $table->integer('desember')->nullable();
            $table->integer('tahun')->nullable();
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
        Schema::dropIfExists('permohonan');
    }
};
