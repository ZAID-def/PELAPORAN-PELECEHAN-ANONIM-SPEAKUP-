<?php

namespace Tests\Browser\Admin;

use App\Models\Laporan;
use App\Models\StatusUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminViewReportDetailTest extends DuskTestCase
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
            'jenis_kejadian' => 'Diskriminasi',
            'lokasi' => 'Gedung Utama Lantai 2',
            'tanggal_kejadian' => now()->subDay(),
            'deskripsi' => 'Detail laporan otomatis untuk pengujian Dusk.',
            'phone' => '081111222233',
            'status' => 'Menunggu Verifikasi',
            'tanggal_lapor' => now(),
            'kode_tracking' => 'TC-DTL-' . strtoupper(Str::random(8)),
            'notes' => 'Catatan awal detail laporan',
        ], $overrides));

        return $this->report;
    }

    public function test_admin_can_view_report_detail(): void
    {
        $report = $this->createReport();

        $this->browse(function (Browser $browser) use ($report) {
            $browser
                ->loginAs($this->admin)
                ->visit('/admin/dashboard?search=' . urlencode($report->kode_tracking))
                ->waitForText('Daftar Laporan Masuk')
                ->assertSee($report->kode_tracking)
                ->click('button[title="Lihat Detail"]')
                ->waitUntil('document.querySelector("#detailModal") && !document.querySelector("#detailModal").classList.contains("hidden")', 5)
                ->assertSee('Detail Laporan')
                ->assertSee($report->kode_tracking)
                ->assertSee($report->jenis_kejadian)
                ->assertSee($report->lokasi)
                ->assertSee($report->deskripsi)
                ->assertSee($report->phone)
                ->click('button[onclick="closeDetail()"]')
                ->waitUntil('document.querySelector("#detailModal").classList.contains("hidden")', 5);
        });
    }
}
