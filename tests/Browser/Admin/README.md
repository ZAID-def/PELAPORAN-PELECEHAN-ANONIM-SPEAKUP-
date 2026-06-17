# Admin Report Management - Dusk Automation Tests

Dokumentasi untuk 4 file test case Dusk untuk fitur Admin - Manajemen Laporan pada project Laravel Pelaporan Pelecehan Anonim SpeakUp.

## 📋 Daftar Test Cases

### 1. **AdminAddReportNoteTest.php** - PBI #25
**Fungsi**: Admin dapat menambahkan atau memperbarui notes pada suatu laporan.

**Test Methods**:
- `test_admin_can_add_report_notes()`: Test menambahkan catatan baru
- `test_admin_can_update_existing_report_notes()`: Test memperbarui catatan yang sudah ada

**Alur Test**:
1. Buat admin dan laporan dummy
2. Login sebagai admin
3. Buka /admin/dashboard
4. Klik tombol edit notes pada laporan
5. Isi textarea dengan teks catatan
6. Klik simpan
7. Assert catatan muncul di halaman dan database

---

### 2. **AdminViewReportDetailTest.php** - PBI #26
**Fungsi**: Admin dapat melihat detail laporan yang masuk.

**Test Methods**:
- `test_admin_can_view_report_detail()`: Test melihat detail laporan lengkap
- `test_admin_can_view_report_detail_without_notes()`: Test detail laporan tanpa catatan
- `test_admin_can_close_report_detail_modal()`: Test menutup modal detail

**Alur Test**:
1. Buat admin dan laporan dummy dengan data lengkap
2. Login sebagai admin
3. Buka /admin/dashboard
4. Klik tombol detail/mata pada laporan
5. Assert semua data penting ditampilkan (ID, status, jenis kejadian, lokasi, tanggal, deskripsi, telepon, catatan)
6. Assert modal dapat ditutup

---

### 3. **AdminUpdateReportStatusTest.php** - PBI #27
**Fungsi**: Admin dapat memperbarui status laporan (Menunggu Verifikasi, Diproses, Ditolak, Selesai).

**Test Methods**:
- `test_admin_can_update_report_status_to_diproses()`: Update ke Diproses
- `test_admin_can_update_report_status_to_selesai()`: Update ke Selesai
- `test_admin_can_update_report_status_to_ditolak()`: Update ke Ditolak
- `test_admin_status_persists_after_page_refresh()`: Status tetap tersimpan setelah refresh

**Alur Test**:
1. Buat admin dan laporan dummy dengan status awal
2. Login sebagai admin
3. Buka /admin/dashboard
4. Ubah status via dropdown select
5. Assert status berhasil berubah
6. Assert pesan sukses muncul
7. Verify status tersimpan di database

---

### 4. **AdminDeleteReportTest.php** - PBI #28
**Fungsi**: Admin dapat menghapus laporan yang tidak valid atau spam.

**Test Methods**:
- `test_admin_can_delete_report()`: Test menghapus laporan
- `test_deleted_report_does_not_appear_after_refresh()`: Laporan tidak muncul setelah refresh
- `test_admin_can_cancel_report_deletion()`: Test membatalkan penghapusan
- `test_admin_can_delete_multiple_reports()`: Test menghapus multiple laporan

**Alur Test**:
1. Buat admin dan laporan dummy
2. Login sebagai admin
3. Buka /admin/dashboard
4. Klik tombol hapus pada laporan
5. Accept confirmation dialog
6. Assert laporan hilang dari daftar
7. Assert pesan sukses muncul
8. Verify laporan dihapus dari database

---

## 🚀 Cara Menjalankan Test

### Prerequisites
- Laravel project sudah ter-setup dengan Dusk
- Database testing sudah dikonfigurasi
- ChromeDriver sudah running di port 9515

### Run All Admin Tests
```bash
php artisan dusk tests/Browser/Admin
```

### Run Specific Test File
```bash
# Test PBI #25 - Add/Update Notes
php artisan dusk tests/Browser/Admin/AdminAddReportNoteTest.php

# Test PBI #26 - View Detail
php artisan dusk tests/Browser/Admin/AdminViewReportDetailTest.php

# Test PBI #27 - Update Status
php artisan dusk tests/Browser/Admin/AdminUpdateReportStatusTest.php

# Test PBI #28 - Delete Report
php artisan dusk tests/Browser/Admin/AdminDeleteReportTest.php
```

### Run Specific Test Method
```bash
php artisan dusk tests/Browser/Admin/AdminAddReportNoteTest.php --filter=test_admin_can_add_report_notes
```

### Run dengan Headed Mode (lihat browser)
```bash
php artisan dusk tests/Browser/Admin --without-tty
```

### Debug Mode
```bash
php artisan dusk tests/Browser/Admin --debug
```

---

## 🔧 Setup Database & Factories

### Pastikan Factories Ada
- ✅ `database/factories/UserFactory.php` - Sudah diupdate dengan field 'role'
- ✅ `database/factories/LaporanFactory.php` - Sudah dibuat baru

### Create Database (jika belum ada)
```bash
php artisan migrate:fresh --database=testing
```

### Seed Database (jika diperlukan)
```bash
php artisan db:seed --database=testing
```

---

## 📍 Dusk Attributes (Selectors)

Berikut adalah atribut `dusk` yang ditambahkan ke dashboard blade untuk stable selectors:

```
@edit-note-{id_laporan}         -> Button edit notes
@detail-report-{id_laporan}     -> Button detail/mata
@delete-report-{id_laporan}     -> Form hapus laporan
@status-select-{id_laporan}     -> Select dropdown status
@modal-detail                   -> Detail modal container
@modal-note                     -> Note modal container
@notes-input                    -> Textarea input for notes
@save-notes-button              -> Simpan button dalam modal notes
```

---

## ✅ Assertions & Validations

### Test Assertions yang Digunakan
- `assertSee()` - Assert teks muncul di halaman
- `assertDontSee()` - Assert teks tidak muncul
- `assertVisible()` - Assert element visible
- `assertInputValue()` - Assert input value
- `assertDatabaseHas()` - Assert record ada di database
- `assertDatabaseMissing()` - Assert record tidak ada di database
- `waitFor()` - Wait untuk element muncul
- `waitForReload()` - Wait untuk halaman reload

### Database Validations
Setiap test juga melakukan validasi di database setelah action untuk memastikan data benar-benar tersimpan.

---

## 🔐 Authentication

Semua test menggunakan `loginAs($admin)` yang memanfaatkan Laravel's authentication system. Admin user dibuat dengan:
```php
$admin = User::factory()->create([
    'name' => 'Admin Test',
    'email' => 'admin@test.local',
    'role' => 'admin',
]);
```

---

## 📝 Test Data

### Admin User Creation
Setiap test membuat admin user dengan role 'admin' menggunakan factory.

### Report Data
Laporan dummy dibuat dengan:
- **kode_tracking**: Unique identifier dengan prefix "DUSK-REPORT-TEST-"
- **status**: Sesuai requirement test (Menunggu Verifikasi, Diproses, dll)
- **jenis_kejadian**: Berbagai tipe kejadian untuk coverage
- **tanggal_kejadian**: Relative dates untuk realistic scenario
- **notes**: null atau teks spesifik sesuai test

---

## 🐛 Troubleshooting

### Test Gagal: Modal tidak muncul
- Pastikan browser JavaScript enabled
- Check bahwa atribut `dusk` ada di blade file
- Lihat console error di browser

### Test Gagal: Database mismatch
- Jalankan `php artisan migrate:fresh --database=testing` sebelum test
- Pastikan `.env.testing` sudah configured dengan benar

### Test Timeout
- Increase timeout di `waitFor()` calls jika server lambat
- Check bahwa app server sudah running

### ChromeDriver Issues
- Pastikan ChromeDriver running: `chromedriver --port=9515`
- Check port conflict: `netstat -ano | findstr :9515` (Windows)

---

## 📊 Test Coverage

| PBI | Test Case | Methods | Coverage |
|-----|-----------|---------|----------|
| #25 | AdminAddReportNoteTest | 2 | Add & Update notes |
| #26 | AdminViewReportDetailTest | 3 | View, No notes, Close modal |
| #27 | AdminUpdateReportStatusTest | 4 | All status changes + persistence |
| #28 | AdminDeleteReportTest | 4 | Delete, Persistence, Cancel, Multiple |

**Total Methods**: 13 test methods
**Total Scenarios**: Covers happy path, edge cases, dan persistence validation

---

## 📚 Referensi

- [Laravel Dusk Documentation](https://laravel.com/docs/dusk)
- [Factories Documentation](https://laravel.com/docs/factory)
- [Testing Best Practices](https://laravel.com/docs/testing)

---

## 👤 Notes

- Test menggunakan `DatabaseMigrations` trait untuk auto-reset database setiap test
- Semua test data dibuat fresh di setiap test method
- Tidak ada dependencies antar test methods
- Setiap test standalone dan dapat dijalankan secara independen
- Pesan sukses ("berhasil", "dihapus", dll) di-assert untuk user experience validation

