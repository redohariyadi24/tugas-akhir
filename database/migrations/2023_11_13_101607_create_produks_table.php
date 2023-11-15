<?php

use App\Models\Artis;
use App\Models\Kategori;
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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignIdFor(Artis::class)->cascadeOnDelete();
            $table->foreignIdFor(Kategori::class)->cascadeOnDelete();
            $table->integer('stok');
            $table->integer('harga');
            $table->text('deskripsi');
            $table->string('gambar')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
