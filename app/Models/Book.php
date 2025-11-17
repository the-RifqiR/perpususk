<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kategori;
use App\Models\Transaction;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'id_kategori',
        'gambar',
        'gambar_url',
        'penulis',
        'tahun_terbit',
        'stok',
    ];

    // relasi 1 Buku hanya punya 1 kategori
    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // 1 Buku punya banyak transaksi
    public function transactions(){
        return $this->hasMany(Transaction::class, 'id_book');
    }
}
