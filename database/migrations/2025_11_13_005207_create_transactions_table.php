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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_book')->nullable()->constrained('books')->nullOnDelete();
            $table->foreignId('id_pengunjung')->constrained('users');
            $table->foreignId('id_petugas')->constrained('users');
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
            $table->date('tanggal_dipinjam')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->date('tanggal_dikembalikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
