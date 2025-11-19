<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Book;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'users_id_pengunjung',
        'users_id_petugas',
        'request_id',
        'status',
        'tanggal_dipinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
    ];

    // relasi 1 transaksi cuman punya 1 buku
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    // relasi 1 transaksi cuman punya 1 pengunjung
    public function pengunjung()
    {
        return $this->belongsTo(User::class, 'users_id_pengunjung');
    }

    // relasi 1 transaksi cuman punya 1 petugas
    public function petugas()
    {
        return $this->belongsTo(User::class, 'users_id_petugas');
    }

    public function request()
    {
        return $this->belongsTo(RequestPeminjaman::class, 'request_id');
    }

    protected $casts = [
        'tanggal_dipinjam'     => 'date',
        'tanggal_kembali'      => 'date',
        'tanggal_dikembalikan' => 'date',
        'created_at'           => 'datetime',
        'updated_at'           => 'datetime',
    ];
}
