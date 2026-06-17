<?php

namespace Tests\Browser;

use App\Models\Bukti;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * =====================================================
 *  TEST MANAJEMEN BUKTI FISIK (PBI #45 - #48)
 *  Total: 11 Test Case
 * =====================================================
 */
class BuktiFisikTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $admin;
    protected $laporanSelesai;
    protected $laporanDiproses;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'name'     => 'Test Admin Dusk',
            'email'    => 'admin.dusk@speakup.test',
            'password' => Hash::make('password123'),
            'role'     => 'super_admin',
        ]);

        $this->laporanSelesai = Laporan::factory()->create([
            'kode_tracking'  => 'SU-DUSK01',
            'jenis_kejadian' => 'Pencurian',
            'status'         => 'Selesai',
            'lokasi'         => 'Jakarta',
        ]);

        $this->laporanDiproses = Laporan::factory()->create([
            'kode_tracking'  => 'SU-DUSK02',
            'jenis_kejadian' => 'Penganiayaan',
            'status'         => 'Diproses',
            'lokasi'         => 'Bandung',
        ]);
    }

    private function loginAsAdmin(Browser $browser): Browser
    {
        return $browser->loginAs($this->admin);
    }

    // ==================== 1. POSITIVE TESTS ====================

    public function test_admin_can_access_bukti_fisik_index_page()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.index')
                ->assertSee('Manajemen Bukti Fisik')
                ->screenshot('01-index-success');
        });
    }

    public function test_admin_can_filter_bukti_by_kode_tracking()
    {
        Bukti::factory()->create([
            'id_laporan'   => $this->laporanSelesai->id_laporan,
            'nama_barang'  => 'Laptop Dell Dusk',
            'lokasi_simpan'=> 'Lemari Test',
            'status_bukti' => 'Disimpan',
        ]);

        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.index')
                ->type('kode_tracking', 'SU-DUSK01')
                ->press('Cari')
                ->pause(2000)
                ->waitForText('SU-DUSK01', 15)
                ->assertSee('Laptop Dell Dusk')
                ->screenshot('02-filter-kode-tracking');
        });
    }

    public function test_admin_can_filter_bukti_by_lokasi_simpan()
    {
        Bukti::factory()->create([
            'id_laporan'   => $this->laporanSelesai->id_laporan,
            'nama_barang'  => 'Handphone Test',
            'lokasi_simpan'=> 'Lemari Dusk-01',
            'status_bukti' => 'Disimpan',
        ]);

        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.index')
                ->type('lokasi_simpan', 'Lemari Dusk-01')
                ->press('Cari')
                ->pause(2000)
                ->waitForText('Handphone Test', 15)
                ->screenshot('03-filter-lokasi-simpan');
        });
    }

    public function test_admin_can_filter_bukti_by_status()
    {
        Bukti::factory()->create([
            'id_laporan'   => $this->laporanSelesai->id_laporan,
            'nama_barang'  => 'Uang Tunai Dusk',
            'lokasi_simpan'=> 'Brankas',
            'status_bukti' => 'Dipinjam',
        ]);

        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.index')
                ->select('status_bukti', 'Dipinjam')
                ->press('Cari')
                ->pause(2000)
                ->waitForText('Uang Tunai Dusk', 15)
                ->screenshot('04-filter-status');
        });
    }

    public function test_admin_can_create_new_bukti_fisik_success()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.create')
                ->select('id_laporan', $this->laporanSelesai->id_laporan)
                ->type('nama_barang', 'Sepeda Motor Honda Dusk')
                ->type('lokasi_simpan', 'Gudang Dusk Lt.2')
                ->type('catatan', 'Test create via Dusk')
                ->click('@btn-daftarkan-bukti')
                ->pause(3000)
                ->waitForText('berhasil didaftarkan', 35)
                ->assertSee('berhasil didaftarkan')
                ->assertSee('Sepeda Motor Honda Dusk')
                ->screenshot('05-create-success');
        });
    }

    public function test_admin_can_update_bukti_status_and_location_success()
    {
        $bukti = Bukti::factory()->create([
            'id_laporan'   => $this->laporanSelesai->id_laporan,
            'nama_barang'  => 'Dokumen Penting Dusk',
            'lokasi_simpan'=> 'Lemari Lama',
            'status_bukti' => 'Disimpan',
        ]);

        $this->browse(function (Browser $browser) use ($bukti) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.edit', $bukti->id_bukti)
                ->select('status_bukti', 'Dipindahkan')
                ->type('lokasi_simpan', 'Lemari Baru Dusk')
                ->type('catatan', 'Update via Dusk test')
                ->click('@btn-update-bukti')
                ->pause(3000)
                ->waitForText('berhasil diperbarui', 35)
                ->assertSee('berhasil diperbarui')
                ->screenshot('06-update-success');
        });
    }

    public function test_admin_can_archive_bukti_when_laporan_is_selesai_success()
    {
        $bukti = Bukti::factory()->create([
            'id_laporan'   => $this->laporanSelesai->id_laporan,
            'nama_barang'  => 'Barang Arsip Dusk',
            'status_bukti' => 'Disimpan',
        ]);

        $this->browse(function (Browser $browser) use ($bukti) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.index')
                ->assertSee('Barang Arsip Dusk')
                ->click('@btn-archive-' . $bukti->id_bukti)
                ->pause(1500)
                ->waitForText('Arsipkan Bukti Fisik')
                ->screenshot('07-archive-success');
        });
    }

    public function test_admin_can_delete_bukti_when_laporan_is_selesai_success()
    {
        $bukti = Bukti::factory()->create([
            'id_laporan'   => $this->laporanSelesai->id_laporan,
            'nama_barang'  => 'Barang Hapus Dusk',
            'status_bukti' => 'Disimpan',
        ]);

        $this->browse(function (Browser $browser) use ($bukti) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.index')
                ->assertSee('Barang Hapus Dusk')
                ->click('@btn-delete-' . $bukti->id_bukti)
                ->acceptDialog()
                ->pause(3000)
                ->waitForText('berhasil dihapus', 20)
                ->assertSee('berhasil dihapus')
                ->screenshot('08-delete-success');
        });
    }

    // ==================== NEGATIVE TESTS ====================

    public function test_create_bukti_fails_when_required_fields_empty()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.create')
                ->click('@btn-daftarkan-bukti')
                ->pause(2000)
                ->waitForText('wajib diisi', 25)
                ->assertSee('wajib diisi')
                ->screenshot('09-create-validation-fail');
        });
    }

    public function test_archive_bukti_fails_if_laporan_not_selesai()
    {
        $bukti = Bukti::factory()->create([
            'id_laporan'   => $this->laporanDiproses->id_laporan,
            'nama_barang'  => 'Bukti Tidak Bisa Diarsip Dusk',
            'status_bukti' => 'Disimpan',
        ]);

        $this->browse(function (Browser $browser) use ($bukti) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.index')
                ->assertSee('Bukti Tidak Bisa Diarsip Dusk')
                ->assertMissing('@btn-archive-' . $bukti->id_bukti)
                ->screenshot('10-archive-fail-not-selesai');
        });
    }

    public function test_delete_bukti_fails_if_laporan_not_selesai()
    {
        $bukti = Bukti::factory()->create([
            'id_laporan'   => $this->laporanDiproses->id_laporan,
            'nama_barang'  => 'Bukti Tidak Bisa Dihapus Dusk',
            'status_bukti' => 'Disimpan',
        ]);

        $this->browse(function (Browser $browser) use ($bukti) {
            $this->loginAsAdmin($browser)
                ->visitRoute('admin.bukti.index')
                ->assertSee('Bukti Tidak Bisa Dihapus Dusk')
                ->assertMissing('@btn-delete-' . $bukti->id_bukti)
                ->screenshot('11-delete-fail-not-selesai');
        });
    }
}
