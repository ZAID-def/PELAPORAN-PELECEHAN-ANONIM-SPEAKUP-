<?php

namespace Tests\Browser;

use App\Models\ReportComparison;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * PBI #41, #42, #43, #44 – Dusk Tests untuk CRUD Perbandingan Antar Laporan
 *
 * Positive Tests:
 *  1. CREATE – Berhasil buat perbandingan baru dengan data valid (PBI #41)
 *  2. READ   – Halaman perbandingan tampil dengan data yang ada (PBI #42)
 *  3. UPDATE – Berhasil edit dan simpan perubahan perbandingan (PBI #43)
 *  4. DELETE – Berhasil hapus perbandingan via confirm dialog (PBI #44)
 *
 * Negative Tests:
 *  5. READ   – Redirect ke login jika belum autentikasi
 *  6. CREATE – Gagal jika nama perbandingan kosong
 *  7. CREATE – Gagal jika bulan awal dan bulan akhir kosong
 *  8. CREATE – Gagal jika tipe perbandingan tidak dipilih
 *  9. CREATE – Gagal jika bulan akhir lebih kecil dari bulan awal
 * 10. CREATE – Gagal jika nama perbandingan melebihi 255 karakter
 */
class PerbandinganLaporanTest extends DuskTestCase
{
    /**
     * Helper: login sebagai admin via CSS selector (#email, #password)
     */
    private function loginAsAdmin(Browser $browser): void
    {
        $browser->visit('/admin/login')
                ->pause(1000)
                ->type('#email', 'admin@speakup.test')
                ->type('#password', 'password123')
                ->press('Masuk')
                ->pause(2000);
    }

    /**
     * Helper: buka modal "Buat Perbandingan Baru" via JS
     */
    private function openCreateModal(Browser $browser): void
    {
        $browser->script('openCreateModal()');
        $browser->pause(800);
    }

    /**
     * Helper: isi form modal perbandingan via JS (karena form menggunakan id bukan name)
     */
    private function fillComparisonForm(
        Browser $browser,
        string $name = '',
        string $startMonth = '',
        string $endMonth = '',
        string $type = '',
        string $category = '',
        string $status = '',
        string $notes = ''
    ): void {
        if ($name !== '') {
            $browser->script("document.getElementById('formName').value = ''");
            $browser->script("document.getElementById('formName').value = " . json_encode($name));
        }
        if ($startMonth !== '') {
            $browser->script("document.getElementById('formStartMonth').value = " . json_encode($startMonth));
        }
        if ($endMonth !== '') {
            $browser->script("document.getElementById('formEndMonth').value = " . json_encode($endMonth));
        }
        if ($type !== '') {
            $browser->script("document.getElementById('formType').value = " . json_encode($type));
        }
        if ($category !== '') {
            $browser->script("document.getElementById('formCategory').value = " . json_encode($category));
        }
        if ($status !== '') {
            $browser->script("document.getElementById('formStatus').value = " . json_encode($status));
        }
        if ($notes !== '') {
            $browser->script("document.getElementById('formNotes').value = " . json_encode($notes));
        }
    }

    /**
     * Helper: klik tombol Simpan di modal form via JS
     */
    private function clickSubmit(Browser $browser): void
    {
        $browser->script('submitForm()');
        $browser->pause(3000);
    }

    /**
     * Helper: bersihkan data test dari DB
     */
    private function cleanupComparison(string $name): void
    {
        ReportComparison::where('name', $name)->delete();
    }

    // =========================================================
    // NEGATIVE TEST - AUTENTIKASI (harus jalan PERTAMA)
    // =========================================================

    /**
     * [NEGATIVE - 5] READ: Redirect ke login jika belum autentikasi
     */
    public function test_a_read_perbandingan_negatif_tanpa_autentikasi()
    {
        $this->browse(function (Browser $browser) {
            // Browser fresh, belum pernah login — langsung akses halaman admin
            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500)
                    ->assertPathIs('/admin/login');
        });
    }

    // =========================================================
    // POSITIVE TESTS
    // =========================================================

    /**
     * [POSITIVE - 1] CREATE (PBI #41): Berhasil buat perbandingan baru dengan data valid
     */
    public function test_create_perbandingan_positif_berhasil_buat()
    {
        $namaPerbandingan = 'Dusk Test Perbandingan ' . time();

        $this->browse(function (Browser $browser) use ($namaPerbandingan) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500)
                    ->assertSee('Perbandingan Laporan');

            // Buka modal create
            $this->openCreateModal($browser);
            $browser->assertVisible('#formModal');

            // Isi form dengan data valid
            $this->fillComparisonForm(
                $browser,
                name: $namaPerbandingan,
                startMonth: '2026-01',
                endMonth: '2026-06',
                type: 'bulanan',
                category: 'Pelecehan Seksual',
                notes: 'Test dari Dusk automation.'
            );

            // Submit
            $this->clickSubmit($browser);

            // Setelah berhasil, halaman akan reload dan data tampil di tabel
            $browser->assertPathIs('/admin/perbandingan-laporan')
                    ->assertSee($namaPerbandingan);
        });

        // Cleanup
        $this->cleanupComparison($namaPerbandingan);
    }

    /**
     * [POSITIVE - 2] READ (PBI #42): Halaman perbandingan tampil dengan data yang ada
     */
    public function test_read_perbandingan_positif_daftar_tampil()
    {
        // Buat data dummy terlebih dahulu
        $admin = User::where('email', 'admin@speakup.test')->first();
        $comparison = ReportComparison::create([
            'name'            => 'Perbandingan Read Test ' . time(),
            'start_month'     => '2026-01-01',
            'end_month'       => '2026-03-01',
            'comparison_type' => 'bulanan',
            'created_by'      => $admin->id,
        ]);

        $this->browse(function (Browser $browser) use ($comparison) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500)
                    ->assertSee('Perbandingan Laporan')
                    ->assertSee('Daftar Perbandingan')
                    ->assertSee($comparison->name)
                    ->assertVisible('table');
        });

        // Cleanup
        $comparison->delete();
    }

    /**
     * [POSITIVE - 3] UPDATE (PBI #43): Berhasil edit dan simpan perubahan perbandingan
     */
    public function test_update_perbandingan_positif_berhasil_edit()
    {
        // Buat data dummy untuk di-edit
        $admin = User::where('email', 'admin@speakup.test')->first();
        $comparison = ReportComparison::create([
            'name'            => 'Perbandingan Edit Dusk ' . time(),
            'start_month'     => '2026-01-01',
            'end_month'       => '2026-03-01',
            'comparison_type' => 'bulanan',
            'created_by'      => $admin->id,
        ]);

        $namaBaru = 'Perbandingan Updated Dusk ' . time();

        $this->browse(function (Browser $browser) use ($comparison, $namaBaru) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500)
                    ->assertSee($comparison->name);

            // Buka modal edit via JS
            $browser->script("openEditModal({$comparison->id})");
            $browser->pause(800);

            // Pastikan modal muncul
            $browser->assertVisible('#formModal');

            // Ganti nama dan tipe
            $this->fillComparisonForm(
                $browser,
                name: $namaBaru,
                startMonth: '2026-02',
                endMonth: '2026-06',
                type: 'kategori',
                notes: 'Diperbarui oleh Dusk test.'
            );

            // Submit
            $this->clickSubmit($browser);

            // Setelah berhasil, halaman reload dan data baru tampil
            $browser->assertPathIs('/admin/perbandingan-laporan')
                    ->assertSee($namaBaru);
        });

        // Cleanup
        ReportComparison::where('name', $namaBaru)->delete();
        $comparison->fresh()?->delete();
    }

    /**
     * [POSITIVE - 4] DELETE (PBI #44): Berhasil hapus perbandingan via confirm dialog
     */
    public function test_delete_perbandingan_positif_berhasil_hapus()
    {
        // Buat data dummy untuk dihapus
        $admin = User::where('email', 'admin@speakup.test')->first();
        $comparison = ReportComparison::create([
            'name'            => 'Perbandingan Hapus Dusk ' . time(),
            'start_month'     => '2026-01-01',
            'end_month'       => '2026-03-01',
            'comparison_type' => 'status',
            'created_by'      => $admin->id,
        ]);

        $this->browse(function (Browser $browser) use ($comparison) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500)
                    ->assertSee($comparison->name);

            // Override confirm() agar otomatis return true
            $browser->driver->executeScript(
                "window.confirm = function() { return true; };"
            );

            $browser->script("deleteComparison({$comparison->id})");
            $browser->pause(3000);

            // Setelah berhasil hapus, halaman reload dan data tidak tampil lagi
            $browser->assertPathIs('/admin/perbandingan-laporan')
                    ->assertDontSee($comparison->name);
        });
    }

    // =========================================================
    // NEGATIVE TESTS
    // =========================================================

    /**
     * [NEGATIVE - 6] CREATE: Gagal jika nama perbandingan kosong
     */
    public function test_create_perbandingan_negatif_nama_kosong()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500);

            // Buka modal create
            $this->openCreateModal($browser);
            $browser->assertVisible('#formModal');

            // Isi form TANPA nama (biarkan kosong)
            $this->fillComparisonForm(
                $browser,
                startMonth: '2026-01',
                endMonth: '2026-06',
                type: 'bulanan'
            );

            // Submit
            $this->clickSubmit($browser);

            // Error harus muncul di modal (client-side validation)
            $browser->assertVisible('#formErrors')
                    ->assertSee('Nama perbandingan wajib diisi.');
        });
    }

    /**
     * [NEGATIVE - 7] CREATE: Gagal jika bulan awal dan bulan akhir kosong
     */
    public function test_create_perbandingan_negatif_bulan_kosong()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500);

            // Buka modal create
            $this->openCreateModal($browser);
            $browser->assertVisible('#formModal');

            // Isi nama dan tipe tapi TANPA bulan
            $this->fillComparisonForm(
                $browser,
                name: 'Test Tanpa Bulan',
                type: 'bulanan'
            );

            // Submit
            $this->clickSubmit($browser);

            // Error harus muncul
            $browser->assertVisible('#formErrors')
                    ->assertSee('Bulan awal wajib diisi.')
                    ->assertSee('Bulan akhir wajib diisi.');
        });
    }

    /**
     * [NEGATIVE - 8] CREATE: Gagal jika tipe perbandingan tidak dipilih
     */
    public function test_create_perbandingan_negatif_tipe_kosong()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500);

            // Buka modal create
            $this->openCreateModal($browser);
            $browser->assertVisible('#formModal');

            // Isi nama dan bulan tapi TANPA tipe
            $this->fillComparisonForm(
                $browser,
                name: 'Test Tanpa Tipe',
                startMonth: '2026-01',
                endMonth: '2026-06'
            );

            // Submit
            $this->clickSubmit($browser);

            // Error harus muncul
            $browser->assertVisible('#formErrors')
                    ->assertSee('Tipe perbandingan wajib dipilih.');
        });
    }

    /**
     * [NEGATIVE - 9] CREATE: Gagal jika bulan akhir lebih kecil dari bulan awal
     */
    public function test_create_perbandingan_negatif_bulan_akhir_sebelum_awal()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500);

            // Buka modal create
            $this->openCreateModal($browser);
            $browser->assertVisible('#formModal');

            // Isi form dengan bulan akhir < bulan awal
            $this->fillComparisonForm(
                $browser,
                name: 'Test Bulan Terbalik',
                startMonth: '2026-06',
                endMonth: '2026-01',
                type: 'bulanan'
            );

            // Submit
            $this->clickSubmit($browser);

            // Error harus muncul
            $browser->assertVisible('#formErrors')
                    ->assertSee('Bulan akhir tidak boleh lebih kecil dari bulan awal.');
        });
    }

    /**
     * [NEGATIVE - 10] CREATE: Gagal jika nama perbandingan melebihi 255 karakter (server-side)
     */
    public function test_create_perbandingan_negatif_nama_terlalu_panjang()
    {
        $namaPanjang = str_repeat('A', 256);

        $this->browse(function (Browser $browser) use ($namaPanjang) {
            $this->loginAsAdmin($browser);

            $browser->visit('/admin/perbandingan-laporan')
                    ->pause(1500);

            // Buka modal create
            $this->openCreateModal($browser);
            $browser->assertVisible('#formModal');

            // Isi form dengan nama > 255 karakter via JS
            $this->fillComparisonForm(
                $browser,
                name: $namaPanjang,
                startMonth: '2026-01',
                endMonth: '2026-06',
                type: 'bulanan'
            );

            // Submit — akan melewati client-side validation tapi gagal di server
            $this->clickSubmit($browser);

            // Error harus muncul dari server-side validation
            $browser->assertVisible('#formErrors');
        });

        // Cleanup jika ternyata tersimpan
        $this->cleanupComparison($namaPanjang);
    }
}
