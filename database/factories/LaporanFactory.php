<?php

namespace Database\Factories;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::factory(),
            'jenis_kejadian' => fake()->randomElement([
                'Pelecehan Verbal',
                'Pelecehan Fisik',
                'Diskriminasi Gender',
                'Diskriminasi Agama',
                'Diskriminasi Ras',
                'Bullying',
                'Cyberbullying',
                'Pelecehan Seksual',
            ]),
            'lokasi' => fake()->randomElement([
                'Ruang Meeting A',
                'Ruang Meeting B',
                'Gedung Utama Lantai 1',
                'Gedung Utama Lantai 2',
                'Gedung Utama Lantai 3',
                'Area Parkir',
                'Kantor Pusat',
                'Kantor Cabang',
                'Ruang Istirahat',
                'Platform Digital Perusahaan',
            ]),
            'tanggal_kejadian' => fake()->dateTimeBetween('-30 days'),
            'deskripsi' => fake()->paragraph(),
            'phone' => fake()->phoneNumber(),
            'status' => fake()->randomElement([
                'Menunggu Verifikasi',
                'Diproses',
                'Selesai',
                'Ditolak',
            ]),
            'tanggal_lapor' => now(),
            'kode_tracking' => 'TRK-' . strtoupper(fake()->unique()->bothify('????##')),
            'notes' => null,
        ];
    }
}
