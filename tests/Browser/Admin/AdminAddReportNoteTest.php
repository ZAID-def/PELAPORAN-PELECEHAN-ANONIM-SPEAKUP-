<?php

namespace Tests\Browser\Admin;

use App\Models\Laporan;
use App\Models\StatusUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminAddReportNoteTest extends DuskTestCase
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
            'jenis_kejadian' => 'Pelecehan Verbal',
            'lokasi' => 'Ruang Testing Notes',
            'tanggal_kejadian' => now()->subDay(),
            'deskripsi' => 'Laporan otomatis untuk test tambah notes.',
            'phone' => '081234567890',
            'status' => 'Menunggu Verifikasi',
            'tanggal_lapor' => now(),
            'kode_tracking' => 'TC-NOTE-' . strtoupper(Str::random(8)),
            'notes' => null,
        ], $overrides));

        return $this->report;
    }

    public function test_admin_can_add_or_update_report_note(): void
    {
        $report = $this->createReport();
        $note = 'Catatan automation test untuk tindak lanjut laporan ' . now()->format('YmdHis');

        $this->browse(function (Browser $browser) use ($report, $note) {
            $browser
                ->loginAs($this->admin)
                ->visit('/admin/dashboard?search=' . urlencode($report->kode_tracking))
                ->waitForText('Daftar Laporan Masuk')
                ->assertSee($report->kode_tracking)
                ->click('button[title="Lihat Detail"]')
                ->waitUntil('document.querySelector("#detailModal") && !document.querySelector("#detailModal").classList.contains("hidden")', 5)
                ->click('#tab-notes-btn')
                ->waitUntil('document.querySelector("#notes-content") && !document.querySelector("#notes-content").classList.contains("hidden")', 5)
                ->type('#detailNotesTextarea', $note)
                ->click('button[onclick="saveNotes()"]')
                ->waitForText('Catatan berhasil disimpan!', 5)
                ->pause(1200);
        });

        $this->assertDatabaseHas('laporans', [
            'id_laporan' => $report->id_laporan,
            'notes' => $note,
        ]);
    }
}
