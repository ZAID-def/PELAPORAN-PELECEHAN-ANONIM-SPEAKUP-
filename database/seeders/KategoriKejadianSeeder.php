<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKejadianSeeder extends Seeder
{
    /**
     * Seed data kategori kejadian awal (data lama yang sudah ada).
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Pelecehan Seksual',
                'deskripsi'     => 'Tindakan berupa pelecehan atau kekerasan yang bersifat seksual.',
                'is_active'     => true,
            ],
            [
                'nama_kategori' => 'Kekerasan Fisik',
                'deskripsi'     => 'Tindakan kekerasan yang menyebabkan cedera atau bahaya fisik.',
                'is_active'     => true,
            ],
            [
                'nama_kategori' => 'Kekerasan Verbal',
                'deskripsi'     => 'Tindakan kekerasan melalui kata-kata, ancaman, atau hinaan.',
                'is_active'     => true,
            ],
            [
                'nama_kategori' => 'Diskriminasi',
                'deskripsi'     => 'Perlakuan tidak adil berdasarkan ras, agama, gender, atau karakteristik lainnya.',
                'is_active'     => true,
            ],
            [
                'nama_kategori' => 'Lainnya',
                'deskripsi'     => 'Jenis kejadian lain yang tidak termasuk dalam kategori di atas.',
                'is_active'     => true,
            ],
        ];

        foreach ($kategoris as $kategori) {
            // Gunakan updateOrInsert agar tidak duplikat jika seeder dijalankan ulang
            DB::table('kategori_kejadians')->updateOrInsert(
                ['nama_kategori' => $kategori['nama_kategori']],
                array_merge($kategori, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
