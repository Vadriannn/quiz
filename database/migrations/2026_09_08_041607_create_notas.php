<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->dateTime('tanggal')->default(now());
            $table->string('metodepembayaran', 45)->nullable();
            $table->integer('pelanggan_id')->nullable()->comment('foreign key ke tabel pelanggan');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans');
            $table->integer('pegawai_id')->nullable()->comment('foreign key ke tabel pegawai');
            $table->foreign('pegawai_id')->references('id')->on('pegawais');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
