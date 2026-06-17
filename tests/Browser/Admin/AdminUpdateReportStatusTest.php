<?php

namespace Tests\Browser\Admin;

use App\Models\Laporan;
use App\Models\StatusUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminUpdateReportStatusTest extends DuskTestCase
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
            'jenis_kejadian' => 'Kekerasan Verbal',
            'lokasi' => 'Ruang Testing Status',
            'tanggal_kejadian' => now()->subDay(),
            'deskripsi' => 'Laporan otomatis untuk test update status.',
            'phone' => '081222333444',
            'status' => 'Menunggu Verifikasi',
            'tanggal_lapor' => now(),
            'kode_tracking' => 'TC-STS-' . strtoupper(Str::random(8)),
            'notes' => null,
        ], $overrides));

        return $this->report;
    }

    public function test_admin_can_update_report_status_to_selesai(): void
    {
        $report = $this->createReport();

        $this->browse(function (Browser $browser) use ($report) {
            $browser
                ->loginAs($this->admin)
                ->visit('/admin/dashboard?search=' . urlencode($report->kode_tracking))
                ->waitForText('Daftar Laporan Masuk')
                ->assertSee($report->kode_tracking);

            /*
             * Jangan pakai:
             * document.querySelector('select[name="status"]')
             *
             * Karena di dashboard ada 2 select name="status":
             * 1. filter status di toolbar
             * 2. dropdown status laporan di tabel
             *
             * Jadi kita target langsung select status laporan berdasarkan id:
             * id="status-{id_laporan}"
             */
            $browser->script("
                const select = document.querySelector('#status-{$report->id_laporan}');
                select.value = 'Selesai';
                select.closest('form').submit();
            ");

            $browser->pause(2000);
        });

        $this->assertDatabaseHas('laporans', [
            'id_laporan' => $report->id_laporan,
            'status' => 'Selesai',
        ]);
    }
}