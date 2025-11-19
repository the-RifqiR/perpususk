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
        Schema::table('transactions', function (Blueprint $table) {
            try {
                $table->dropForeign(['id_petugas']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['id_pengunjung']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['id_book']);
            } catch (\Exception $e) {
            }


            $table->renameColumn('id_petugas', 'users_id_petugas');
            $table->renameColumn('id_pengunjung', 'users_id_pengunjung');
            $table->renameColumn('id_book', 'book_id');        
        });
    
        Schema::table('transactions', function(Blueprint $table){
            $table->unsignedBigInteger('users_id_petugas')->nullable()->change();
            $table->unsignedBigInteger('users_id_pengunjung')->nullable()->change();
            $table->unsignedBigInteger('book_id')->nullable()->change();

            $table->foreign('users_id_petugas')->references('id')->on('users')->onDelete('set null');
            $table->foreign('users_id_pengunjung')->references('id')->on('users')->onDelete('set null');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function(Blueprint $table){

            $table->renameColumn('users_id_petugas', 'id_petugas');
            $table->renameColumn('users_id_pengunjung', 'id_pengunjung');
            $table->renameColumn('book_id', 'id_book');
        });
    }
};
