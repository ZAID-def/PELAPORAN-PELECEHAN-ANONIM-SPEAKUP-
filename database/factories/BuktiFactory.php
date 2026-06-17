<?php

namespace Database\Factories;

use App\Models\Bukti;
use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuktiFactory extends Factory
{
    protected $model = Bukti::class;

    public function definition(): array
    {
        return [
            'id_laporan'    => Laporan::factory(),
            'nama_barang'   => fake()->words(3, true),
            'file_bukti'    => '',           // <-- UBAH INI dari null menjadi ''
            'tipe_file'     => '-',
            'status_bukti'  => fake()->randomElement(['Disimpan', 'Dipinjam', 'Dipindahkan']),
            'lokasi_simpan' => fake()->randomElement(['Lemari Utama', 'Gudang Barang Bukti', 'Brankas']),
            'catatan'       => fake()->sentence(),
        ];
    }
}