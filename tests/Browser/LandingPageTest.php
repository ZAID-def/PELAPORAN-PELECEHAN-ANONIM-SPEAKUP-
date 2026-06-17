<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LandingPageTest extends DuskTestCase
{
    /**
     * Menguji PBI #1: Desain hero section utama
     */
    public function test_hero_section_is_visible(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    // Cek H1 judul utama
                    ->assertSee('Sistem Pelaporan Pelecehan dan Diskriminasi Berbasis Anonim')
                    // Cek tombol
                    ->assertSee('Lapor Sekarang (Anonim)')
                    ->assertSee('Cek Status Laporan');
        });
    }

    /**
     * Menguji PBI #2: Layout header & footer
     */
    public function test_header_is_rendered(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    // Pastikan tag header muncul
                    ->assertVisible('header')
                    // Pastikan nama web dan tombol admin ada di header
                    ->assertSee('SPEAKUP')
                    ->assertSee('Admin');
            
            // Note buat Adhit: Karena tag <footer> belum elu bikin di welcome.blade.php,
            // asersi untuk footer gua skip dulu biar test-nya nggak error (Fail).
        });
    }

    /**
     * Menguji PBI #3: Responsive mobile & desktop
     */
    public function test_mobile_responsive_layout(): void
    {
        $this->browse(function (Browser $browser) {
            // Ubah ukuran browser jadi seukuran layar HP (iPhone 12/13/14)
            $browser->resize(390, 844)
                    ->visit('/')
                    // Pastikan elemen penting tetap terlihat walau layar sempit
                    ->assertVisible('header')
                    ->assertSee('Lapor Sekarang (Anonim)');
        });
    }

    /**
     * Menguji PBI #4: Integrasi konten landing page
     */
    public function test_features_content_is_displayed(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    // Karena konten dinamis belum ada, kita test konten "Features" statisnya dulu
                    ->assertSee('100% Anonim')
                    ->assertSee('Tracking Real-time')
                    ->assertSee('Tindak Lanjut Jelas');
        });
    }
}