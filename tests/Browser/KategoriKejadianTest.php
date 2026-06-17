<?php

namespace Tests\Browser;

use App\Models\KategoriKejadian;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * KAN-38 & KAN-39 – Dusk Tests untuk CRUD Kategori Jenis Kejadian
 *
 * Positive Tests:
 *  1. CREATE – Berhasil tambah kategori dengan data valid
 *  2. READ   – Halaman daftar kategori tampil & data terbaca
 *  3. UPDATE – Berhasil edit & simpan perubahan kategori
 *  4. DELETE – Berhasil hapus kategori melalui modal konfirmasi
 *
 * Negative Tests:
 *  5. READ   – Redirect ke login jika belum autentikasi (dijalankan PERTAMA)
 *  6. CREATE – Gagal jika nama kategori kosong
 *  7. CREATE – Gagal jika nama kategori duplikat
 *  8. CREATE – Gagal jika nama kategori melebihi 255 karakter
 *  9. UPDATE – Gagal jika nama kategori dikosongkan saat edit
 * 10. CREATE – Gagal jika deskripsi melebihi 500 karakter
 */
class KategoriKejadianTest extends DuskTestCase
{
    /**
     * Helper: login sebagai admin
     */
    private function loginAsAdmin(Browser $browser): void
    {
        $browser->visit('/admin/login')
                ->type('email', 'test@example.com')
                ->type('password', 'password')
                ->press('Masuk')
                ->pause(1500);
    }

    /**
     * Helper: logout via form submit JS (invalidate server-side session)
     */
    private function logoutAdmin(Browser $browser): void
    {
        // Kunjungi dashboard (ada form logout di sana), lalu submit via JS
        $browser->visit('/admin/dashboard')
                ->pause(500);
        $browser->script("
            var form = document.querySelector('form[action*=\"admin/logout\"]');
            if (form) form.submit();
        ");
        $browser->pause(1500);
    }

    /**
     * Helper: bersihkan kategori test dari DB setelah test
     */
    private function cleanupKategori(string $nama): void
    {
        KategoriKejadian::where('nama_kategori', $nama)->delete();
    }

    // =========================================================
    // NEGATIVE TEST - AUTENTIKASI (harus jalan PERTAMA, sebelum login)
    // =========================================================

    /**
     * [NEGATIVE - 5] READ: Redirect ke login jika belum autentikasi
     * CATATAN: Test ini diletakkan pertama agar browser belum punya session login.
     */
    public function test_a_read_kategori_negatif_tanpa_autentikasi()
    {
        $this->browse(function (Browser $browser) {
            // Browser fresh, belum pernah login — langsung akses halaman admin
            $browser->visit('/admin/kategori')
                    ->pause(1000)
                    ->assertPathIs('/admin/login');
        });
    }

    // =========================================================
    // POSITIVE TESTS
    // =========================================================

    /**
     * [POSITIVE - 1] CREATE: Berhasil tambah kategori baru dengan data lengkap & valid
     */
    public function test_create_kategori_positif_berhasil_tambah()
    {
        $namaKategori = 'Kategori Dusk Test ' . time();

        $this->browse(function (Browser $browser) use ($namaKategori) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/kategori/create')
                    ->assertSee('Tambah Kategori Baru')
                    ->type('nama_kategori', $namaKategori)
                    ->type('deskripsi', 'Deskripsi test dari Dusk automation.')
                    ->check('is_active')
                    ->press('Tambah Kategori')
                    ->pause(1500)
                    ->assertPathIs('/admin/kategori')
                    ->assertSee('berhasil ditambahkan')
                    ->assertSee($namaKategori);
        });

        $this->cleanupKategori($namaKategori);
    }

    /**
     * [POSITIVE - 2] READ: Halaman daftar kategori tampil dengan data yang ada
     */
    public function test_read_kategori_positif_daftar_tampil()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/kategori')
                    ->assertSee('Daftar Kategori')
                    ->assertSee('Pelecehan Seksual')
                    ->assertSee('Kekerasan Fisik')
                    ->assertSee('Tambah Kategori')
                    ->assertVisible('table');
        });
    }

    /**
     * [POSITIVE - 3] UPDATE: Berhasil edit dan simpan perubahan kategori
     */
    public function test_update_kategori_positif_berhasil_edit()
    {
        // Buat kategori sementara untuk di-edit
        $kategori = KategoriKejadian::create([
            'nama_kategori' => 'Kategori Edit Dusk ' . time(),
            'deskripsi'     => 'Deskripsi awal.',
            'is_active'     => true,
        ]);

        $namaBaru = 'Kategori Edit Dusk Updated ' . time();

        $this->browse(function (Browser $browser) use ($kategori, $namaBaru) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/kategori/' . $kategori->id . '/edit')
                    ->assertSee('Edit Kategori')
                    ->assertInputValue('nama_kategori', $kategori->nama_kategori)
                    ->clear('nama_kategori')
                    ->type('nama_kategori', $namaBaru)
                    ->clear('deskripsi')
                    ->type('deskripsi', 'Deskripsi telah diperbarui oleh Dusk.')
                    ->press('Simpan Perubahan')
                    ->pause(1500)
                    ->assertPathIs('/admin/kategori')
                    ->assertSee('berhasil diperbarui')
                    ->assertSee($namaBaru);
        });

        // Cleanup
        KategoriKejadian::where('nama_kategori', $namaBaru)->delete();
        $kategori->fresh()?->delete();
    }

    /**
     * [POSITIVE - 4] DELETE: Berhasil hapus kategori melalui modal konfirmasi
     */
    public function test_delete_kategori_positif_berhasil_hapus()
    {
        // Buat kategori sementara untuk dihapus
        $kategori = KategoriKejadian::create([
            'nama_kategori' => 'Kategori Hapus Dusk ' . time(),
            'deskripsi'     => 'Akan dihapus.',
            'is_active'     => true,
        ]);

        $this->browse(function (Browser $browser) use ($kategori) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/kategori')
                    ->assertSee($kategori->nama_kategori);

            // Trigger fungsi JS confirmDelete() langsung (script() mengembalikan array, bukan Browser)
            $browser->script("confirmDelete({$kategori->id}, '" . addslashes($kategori->nama_kategori) . "')");

            $browser->pause(600)
                    // Modal konfirmasi harus muncul
                    ->assertVisible('#deleteModal')
                    ->assertSee('Konfirmasi Hapus')
                    ->assertSee($kategori->nama_kategori)
                    // Klik tombol "Ya, Hapus"
                    ->click('#deleteForm button[type="submit"]')
                    ->pause(2000)
                    ->assertPathIs('/admin/kategori')
                    ->assertSee('berhasil dihapus');

            // script() mengembalikan array — panggil terpisah, tidak bisa di-chain
            $browser->script("let el = document.getElementById('alert-success'); if(el) el.remove();");

            // Setelah alert hilang, pastikan baris kategori tidak ada lagi di tabel
            $browser->pause(300)
                    ->assertDontSee($kategori->nama_kategori);
        });
    }

    // =========================================================
    // NEGATIVE TESTS
    // =========================================================

    /**
     * [NEGATIVE - 6] CREATE: Gagal jika nama kategori dikosongkan
     */
    public function test_create_kategori_negatif_nama_kosong()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/kategori/create');

            // Bypass HTML5 required validation
            $browser->script("document.getElementById('nama_kategori').removeAttribute('required')");

            $browser->clear('nama_kategori')
                    ->type('deskripsi', 'Deskripsi tanpa nama kategori.')
                    ->press('Tambah Kategori')
                    ->pause(1500)
                    ->assertPathIs('/admin/kategori/create')
                    ->assertSee('Nama kategori wajib diisi.');
        });
    }

    /**
     * [NEGATIVE - 7] CREATE: Gagal jika nama kategori sudah ada (duplikat)
     */
    public function test_create_kategori_negatif_nama_duplikat()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);

            // Coba tambah kategori yang sudah ada di database
            $browser->visit('/admin/kategori/create')
                    ->type('nama_kategori', 'Pelecehan Seksual')
                    ->type('deskripsi', 'Mencoba duplikat kategori.')
                    ->press('Tambah Kategori')
                    ->pause(1500)
                    ->assertPathIs('/admin/kategori/create')
                    ->assertSee('Kategori dengan nama tersebut sudah ada.');
        });
    }

    /**
     * [NEGATIVE - 8] CREATE: Gagal jika nama kategori melebihi 255 karakter
     */
    public function test_create_kategori_negatif_nama_terlalu_panjang()
    {
        $namaPanjang = str_repeat('A', 256); // 256 karakter, melebihi batas 255

        $this->browse(function (Browser $browser) use ($namaPanjang) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/kategori/create');
            $browser->script("document.getElementById('nama_kategori').removeAttribute('maxlength')");

            $browser->type('nama_kategori', $namaPanjang)
                    ->press('Tambah Kategori')
                    ->pause(1500)
                    ->assertPathIs('/admin/kategori/create')
                    ->assertSee('Nama kategori maksimal 255 karakter.');
        });
    }

    /**
     * [NEGATIVE - 9] UPDATE: Gagal jika nama kategori dikosongkan saat edit
     */
    public function test_update_kategori_negatif_nama_kosong()
    {
        // Ambil kategori yang sudah ada
        $kategori = KategoriKejadian::where('nama_kategori', 'Pelecehan Seksual')->firstOrFail();

        $this->browse(function (Browser $browser) use ($kategori) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/kategori/' . $kategori->id . '/edit')
                    ->assertSee('Edit Kategori');

            // Bypass required attribute
            $browser->script("document.getElementById('nama_kategori').removeAttribute('required')");

            $browser->clear('nama_kategori')
                    ->press('Simpan Perubahan')
                    ->pause(1500)
                    ->assertPathIs('/admin/kategori/' . $kategori->id . '/edit')
                    ->assertSee('Nama kategori wajib diisi.');
        });
    }

    /**
     * [NEGATIVE - 10] CREATE: Gagal jika deskripsi melebihi 500 karakter
     */
    public function test_create_kategori_negatif_deskripsi_terlalu_panjang()
    {
        $deskripsiPanjang = str_repeat('D', 501); // 501 karakter, melebihi batas 500

        $this->browse(function (Browser $browser) use ($deskripsiPanjang) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/kategori/create')
                    ->type('nama_kategori', 'Kategori Deskripsi Panjang Test');

            // Bypass maxlength di textarea
            $browser->script("document.getElementById('deskripsi').removeAttribute('maxlength')");

            $browser->type('deskripsi', $deskripsiPanjang)
                    ->press('Tambah Kategori')
                    ->pause(1500)
                    ->assertPathIs('/admin/kategori/create')
                    ->assertSee('Deskripsi maksimal 500 karakter.');
        });

        $this->cleanupKategori('Kategori Deskripsi Panjang Test');
    }
}
