<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestPeminjaman extends Model
{
    protected $table = 'request_peminjaman';

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'keterangan',
        'tanggal_kembali',
    ];

    protected $casts = [
        'tanggal_kembali' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi: satu request dimiliki oleh satu user (pengunjung)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: satu request terkait dengan satu buku
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
