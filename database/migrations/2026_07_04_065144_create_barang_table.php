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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();

            $table->string('kode_barang', 20)->unique();
            $table->string('nama_barang', 150);

            $table->foreignId('kategori_id')
                ->constrained('kategori')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('supplier_id')
                ->constrained('supplier')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('gudang_id')
                ->constrained('gudang')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->integer('stok')->default(0);
            $table->integer('stok_minimum')->default(5);

            $table->string('satuan', 30);

            $table->decimal('harga', 15, 2);

            $table->string('foto_barang')->nullable();

            $table->enum('status', ['Aktif', 'Nonaktif'])
                ->default('Aktif');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
