<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Carbon\Carbon;

class LaporanAnonimTest extends DuskTestCase
{
    /**
     * Helper untuk mengisi form yang valid agar bisa fokus testing 1 field
     */
    private function fillValidForm(Browser $browser)
    {
        $browser->select('jenis_kejadian', 'Pelecehan Seksual')
                ->value('#tanggal_kejadian', Carbon::now()->subDay()->format('Y-m-d\TH:i'))
                ->type('lokasi', 'Gedung Fakultas Teknik')
                ->type('deskripsi', 'Seseorang mengambil foto secara diam-diam.')
                ->type('phone', '081234567890');
    }

    /** 1. Jenis Kejadian Positive */
    public function test_jenis_kejadian_positive()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            $browser->select('jenis_kejadian', 'Kekerasan Fisik')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor/sukses');
        });
    }

    /** 2. Jenis Kejadian Negative (Kosong) */
    public function test_jenis_kejadian_negative()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            // Bypass HTML5 validation
            $browser->script("document.getElementById('jenis_kejadian').removeAttribute('required')");
            $browser->select('jenis_kejadian', '')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor')
                    ->assertSee('Data Belum Lengkap!');
        });
    }

    /** 3. Waktu Kejadian Positive */
    public function test_waktu_kejadian_positive()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            $browser->value('#tanggal_kejadian', Carbon::now()->subHours(2)->format('Y-m-d\TH:i'))
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor/sukses');
        });
    }

    /** 4. Waktu Kejadian Negative (Masa Depan) */
    public function test_waktu_kejadian_negative()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            // Bypass HTML5 max attribute
            $browser->script("document.getElementById('tanggal_kejadian').removeAttribute('max')");
            // Set ke masa depan (besok)
            $browser->value('#tanggal_kejadian', Carbon::now()->addDays(1)->format('Y-m-d\TH:i'))
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor')
                    ->assertSee('Data Belum Lengkap!');
        });
    }

    /** 5. Lokasi Positive */
    public function test_lokasi_positive()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            $browser->type('lokasi', 'Kantin Kampus Utama')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor/sukses');
        });
    }

    /** 6. Lokasi Negative (Kosong) */
    public function test_lokasi_negative()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            $browser->script("document.getElementById('lokasi').removeAttribute('required')");
            // Kosongkan form input
            $browser->clear('lokasi')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor')
                    ->assertSee('Data Belum Lengkap!');
        });
    }

    /** 7. Deskripsi Positive */
    public function test_deskripsi_positive()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            $browser->type('deskripsi', 'Penjelasan yang sangat panjang dan detail tentang kejadian.')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor/sukses');
        });
    }

    /** 8. Deskripsi Negative (Kosong) */
    public function test_deskripsi_negative()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            $browser->script("document.getElementById('deskripsi').removeAttribute('required')");
            $browser->clear('deskripsi')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor')
                    ->assertSee('Data Belum Lengkap!');
        });
    }

    /** 9. Phone Positive (Angka) */
    public function test_phone_positive()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            $browser->type('phone', '08123456789')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor/sukses');
        });
    }

    /** 10. Phone Negative (Mengandung Huruf) */
    public function test_phone_negative()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/lapor');
            $this->fillValidForm($browser);
            // Menghapus atribut pattern dan javascript oninput
            $browser->script("document.getElementById('phone').removeAttribute('pattern'); document.getElementById('phone').removeAttribute('oninput');");
            $browser->type('phone', '0812ABCDEF')
                    ->press('Kirim Laporan')
                    ->pause(1500)
                    ->assertPathIs('/lapor')
                    ->assertSee('Data Belum Lengkap!');
        });
    }
}
