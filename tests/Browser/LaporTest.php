<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\KategoriKejadian;
use Carbon\Carbon;

class LaporTest extends DuskTestCase
{
    /**
     * Pastikan minimal ada 1 kategori untuk dites
     */
    protected function setUp(): void
    {
        parent::setUp();
        KategoriKejadian::firstOrCreate([
            'nama_kategori' => 'Pelecehan Seksual',
        ], [
            'deskripsi' => 'Pelecehan Seksual',
            'is_active' => true,
        ]);
    }

    /**
     * [POSITIVE] Submit form pelaporan dengan data valid
     */
    public function test_lapor_positif_berhasil_submit()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080)
                    ->visit('/lapor')
                    ->assertSee('Lapor Anonim')
                    ->select('jenis_kejadian', 'Pelecehan Seksual')
                    ->script("document.getElementById('tanggal_kejadian').value = '2023-12-12T10:30';");
            $browser->type('lokasi', 'Kampus ABC')
                    ->type('deskripsi', 'Terjadi pelecehan di area parkir.')
                    ->type('phone', '081234567890')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor/sukses')
                    ->assertSee('Laporan Berhasil Dikirim!');
        });
    }

    /**
     * [NEGATIVE] Waktu kejadian tidak boleh masa depan
     */
    public function test_lapor_negatif_tanggal_kejadian_masa_depan()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080)
                    ->visit('/lapor')
                    // Hapus validasi HTML5 max
                    ->script("document.getElementById('tanggal_kejadian').removeAttribute('max');");
            
            // Masukkan tanggal masa depan (tahun depan)
            $futureYear = date('Y') + 1;
            
            $browser->select('jenis_kejadian', 'Pelecehan Seksual')
                    ->script("document.getElementById('tanggal_kejadian').value = '" . $futureYear . "-12-12T10:30';");
            $browser->type('lokasi', 'Kampus ABC')
                    ->type('deskripsi', 'Kejadian dari masa depan.')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor')
                    ->assertSee('before or equal to');
        });
    }

    /**
     * [NEGATIVE] Nomor telepon maksimal 12 angka (lebih dari 12 gagal)
     */
    public function test_lapor_negatif_nomor_telepon_terlalu_panjang()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080)
                    ->visit('/lapor')
                    // Hapus batasan maxlength frontend
                    ->script("document.getElementById('phone').removeAttribute('maxlength');");
            
            $browser->select('jenis_kejadian', 'Pelecehan Seksual')
                    ->script("document.getElementById('tanggal_kejadian').value = '2023-12-12T10:30';");
            $browser->type('lokasi', 'Jalan Raya')
                    ->type('deskripsi', 'Testing nomor terlalu panjang.')
                    ->type('phone', '081234567890123') // 15 karakter
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor')
                    ->assertSee('not be greater than 12'); // pesan validasi default Laravel
        });
    }

    /**
     * [NEGATIVE] Submit form tanpa data wajib (jenis_kejadian, lokasi, dll)
     */
    public function test_lapor_negatif_form_kosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080)
                    ->visit('/lapor')
                    // Hapus semua required agar bisa disubmit kosong ke backend
                    ->script("
                        document.getElementById('jenis_kejadian').removeAttribute('required');
                        document.getElementById('tanggal_kejadian').removeAttribute('required');
                        document.getElementById('lokasi').removeAttribute('required');
                        document.getElementById('deskripsi').removeAttribute('required');
                    ");
            
            $browser->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor')
                    // Cek error dari backend
                    ->assertSee('field is required')
                    ->assertSee('field is required')
                    ->assertSee('field is required')
                    ->assertSee('field is required');
        });
    }
}
