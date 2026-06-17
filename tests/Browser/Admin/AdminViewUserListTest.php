<?php

namespace Tests\Browser\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminViewUserListTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $superAdmin;
    protected $regularAdmin;

    public function setUp(): void
    {
        parent::setUp();
        
        // Create test users
        $this->superAdmin = User::create([
            'name' => 'Super Admin Test',
            'email' => 'superadmin@test.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
        ]);

        $this->regularAdmin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com', 
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }

    /**
     * Test 1: Super Admin dapat akses halaman kelola user
     * @test
     */
    public function test_super_admin_can_access_user_management_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1500)
                ->assertPathIs('/admin/users')
                ->assertSee('Kelola User')
                ->assertSee($this->superAdmin->name)
                ->assertSee($this->regularAdmin->name)
                ->screenshot('user_management_page');
        });
    }

    /**
     * Test 2: READ - User list menampilkan semua admin
     * @test
     */
    public function test_user_list_displays_all_admins()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->assertSee($this->superAdmin->name)
                ->assertSee($this->regularAdmin->name)
                ->assertSee($this->superAdmin->email)
                ->assertSee($this->regularAdmin->email)
                ->assertSee('Super Admin')
                ->assertSee('Admin')
                ->screenshot('user_list_display');
        });
    }

    /**
     * Test 3: Halaman menampilkan jumlah total admin
     * @test
     */
    public function test_page_displays_admin_statistics()
    {
        $totalAdmins = User::whereIn('role', ['admin', 'super_admin'])->count();
        
        $this->browse(function (Browser $browser) use ($totalAdmins) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->assertSee('Total Admin')
                ->assertSee((string)$totalAdmins)
                ->screenshot('admin_statistics');
        });
    }

    /**
     * Test 4: Authorization - Regular admin tidak bisa akses halaman
     * @test
     */
    public function test_regular_admin_cannot_access_user_management()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->regularAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                // Should be redirected or see error message
                ->assertDontSee('Kelola User')
                ->screenshot('regular_admin_denied_access');
        });
    }

    /**
     * Test 5: Tampilkan form tambah admin di halaman
     * @test
     */
    public function test_page_displays_add_admin_form()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->assertSee('Tambah Admin Baru')
                ->assertVisible('input[name="name"]')
                ->assertVisible('input[name="email"]')
                ->assertVisible('input[name="password"]')
                ->assertVisible('input[name="password_confirmation"]')
                ->assertVisible('select[name="role"]')
                ->assertVisible('button[type="submit"]'); // Fixed selector
        });
    }

    /**
     * Test 6: Tampilkan tabel daftar admin dengan kolom yang benar
     * @test
     */
    public function test_user_table_displays_correct_columns()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->assertSee('Daftar Admin')
                ->within('table thead', function ($browser) {
                    $browser->assertSee('NAMA')
                          ->assertSee('EMAIL')
                          ->assertSee('PERAN')
                          ->assertSee('AKSI');
                });
        });
    }
}