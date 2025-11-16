<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add a check constraint to ensure stok tidak negatif.
        // Note: MySQL 8+ dan PostgreSQL mendukung CHECK constraints. Jika DB Anda older MySQL,
        // Anda mungkin perlu menginstall doctrine/dbal dan mengubah tipe kolom menjadi unsigned.
        try {
            DB::statement('ALTER TABLE books ADD CONSTRAINT chk_stok_nonnegative CHECK (stok >= 0)');
        } catch (\Exception $e) {
            // Jika DB tidak mendukung atau constraint sudah ada, lewati.
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            DB::statement('ALTER TABLE books DROP CHECK chk_stok_nonnegative');
        } catch (\Exception $e) {
            // ignore
        }
    }
};
