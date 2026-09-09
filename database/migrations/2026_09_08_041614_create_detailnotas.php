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
        Schema::create('detailnotas', function (Blueprint $table) {
            $table->integer('nota_id')->nullable()->comment('foreign key ke tabel nota');
            $table->foreign('nota_id')->references('id')->on('notas')->onDelete('cascade');
            
            $table->unsignedBigInteger('barang_id')->nullable()->comment('foreign key ke tabel barang');
            $table->foreign('barang_id')->references('id')->on('barangs');
            $table->integer('jumlah')->nullable()->comment('jumlah barang');
            $table->decimal('subtotal', 15, 2)->nullable()->comment('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailnotas');
    }
};
