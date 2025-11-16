<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Book;

class Kategori extends Model
{
      use HasFactory;

       protected $fillable = [
        'nama',
    ];

    // Relasi 1 kategori bisa banyak buku
    public function books(){
        return $this->hasMany(Book::class, 'id_kategori');
    }
}
