<?php

namespace Tests\Browser\Admin;

use App\Models\Laporan;
use App\Models\StatusUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminDeleteReportTest extends DuskTestCase
{
    protected ?User $admin = null;
    protected ?Laporan $report = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = $this->createSuperAdmin();
    }

    protected function tearDown(): void
    {
        if ($this->report) {
            StatusUpdate::where('id_laporan', $this->report->id_laporan)->delete();
            Laporan::where('id_laporan', $this->report->id_laporan)->delete();
        }

        if ($this->admin) {
            $this->admin->delete();
        }

        parent::tearDown();
    }

    private function createSuperAdmin(): User
    {
        $admin = new User();
        $admin->name = 'Dusk Super Admin ' . Str::random(5);
        $admin->email = 'dusk-super-admin-' . Str::uuid() . '@speakup.test';
        $admin->password = Hash::make('password123');
        $admin->role = 'super_admin';
        $admin->email_verified_at = now();
        $admin->save();

        return $admin;
    }

    private function createReport(array $overrides = []): Laporan
    {
        $this->report = Laporan::create(array_merge([
            'id_user' => null,
            'jenis_kejadian' => 'Spam Testing',
            'lokasi' => 'Ruang Testing Hapus',
            'tanggal_kejadian' => now()->subDay(),
            'deskripsi' => 'Laporan dummy/spam khusus untuk test hapus.',
            'phone' => '081999888777',
            'status' => 'Menunggu Verifikasi',
            'tanggal_lapor' => now(),
            'kode_tracking' => 'TC-DEL-' . strtoupper(Str::random(8)),
            'notes' => null,
        ], $overrides));

        return $this->report;
    }

    public function test_admin_can_delete_report(): void
    {
        $report = $this->createReport();

        $this->browse(function (Browser $browser) use ($report) {
            $browser
                ->loginAs($this->admin)
                ->visit('/admin/dashboard?search=' . urlencode($report->kode_tracking))
                ->waitForText('Daftar Laporan Masuk')
                ->assertSee($report->kode_tracking)
                ->click('button[title="Hapus Laporan"]')
                ->acceptDialog()
                ->waitForText('Laporan berhasil dihapus.', 5)
                ->assertDontSee($report->kode_tracking);
        });

        $this->assertDatabaseMissing('laporans', [
            'id_laporan' => $report->id_laporan,
        ]);
    }
}
