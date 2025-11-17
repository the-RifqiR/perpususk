<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph(),
            'id_kategori' => null, // atau random kategori jika sudah ada datanya
            'gambar' => null, // kolom lama (boleh dikosongkan)
            'gambar_url' => $this->faker->imageUrl(300, 450, 'books', true), // contoh gambar dummy
            'penulis' => $this->faker->name(),
            'tahun_terbit' => $this->faker->date(),
            'stok' => $this->faker->numberBetween(1, 20),
        ];
    }
}