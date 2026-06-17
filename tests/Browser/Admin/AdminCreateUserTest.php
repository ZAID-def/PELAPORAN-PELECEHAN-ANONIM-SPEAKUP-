<?php

namespace Tests\Browser\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminCreateUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $superAdmin;

    public function setUp(): void
    {
        parent::setUp();
        
        // Create test super admin
        $this->superAdmin = User::create([
            'name' => 'Super Admin Test',
            'email' => 'superadmin@test.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
        ]);
    }

    /**
     * Test 1: CREATE - Tambah user baru dengan role admin
     * @test  
     */
    public function test_super_admin_can_create_new_admin()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->type('input[name="name"]', 'Admin Baru Test')
                ->type('input[name="email"]', 'adminbaru@test.com')
                ->type('input[name="password"]', 'password123')
                ->type('input[name="password_confirmation"]', 'password123')
                ->select('select[name="role"]', 'admin')
                ->press('Tambah User')
                ->pause(2000)
                ->assertSee('Admin berhasil ditambahkan')
                ->assertSee('Admin Baru Test');

            // Verify database
            $this->assertDatabaseHas('users', [
                'name' => 'Admin Baru Test',
                'email' => 'adminbaru@test.com',
                'role' => 'admin',
            ]);
        });
    }

    /**
     * Test 2: CREATE - Tambah user dengan role super_admin
     * @test
     */
    public function test_super_admin_can_create_super_admin_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->type('input[name="name"]', 'Super Admin Baru')
                ->type('input[name="email"]', 'superadminbaru@test.com')
                ->type('input[name="password"]', 'password123')
                ->type('input[name="password_confirmation"]', 'password123')
                ->select('select[name="role"]', 'super_admin')
                ->press('Tambah User')
                ->pause(2000)
                ->assertSee('Admin berhasil ditambahkan')
                ->assertSee('Super Admin Baru');

            // Verify database
            $this->assertDatabaseHas('users', [
                'name' => 'Super Admin Baru',
                'email' => 'superadminbaru@test.com',
                'role' => 'super_admin',
            ]);
        });
    }

    /**
     * Test 3: Validasi - Email harus unik
     * @test
     */
    public function test_create_user_with_duplicate_email_shows_error()
    {
        // Create existing user first
        User::create([
            'name' => 'Existing User',
            'email' => 'existing@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->type('input[name="name"]', 'Duplicate Email User')
                ->type('input[name="email"]', 'existing@test.com') // Existing email
                ->type('input[name="password"]', 'password123')
                ->type('input[name="password_confirmation"]', 'password123')
                ->select('select[name="role"]', 'admin')
                ->press('Tambah User')
                ->pause(2000)
                ->assertSee('The email has already been taken');
        });
    }

    /**
     * Test 4: Validasi - Password minimal 8 karakter
     * @test
     */
    public function test_create_user_with_short_password_shows_error()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->type('input[name="name"]', 'Short Password User')
                ->type('input[name="email"]', 'shortpass@test.com')
                ->type('input[name="password"]', 'pass')  // Too short
                ->type('input[name="password_confirmation"]', 'pass')
                ->select('select[name="role"]', 'admin')
                ->press('Tambah User')
                ->pause(2000)
                ->assertSee('The password field must be at least 8 characters');
        });
    }

    /**
     * Test 5: Validasi - Password confirmation harus cocok
     * @test
     */
    public function test_create_user_with_mismatched_password_shows_error()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->type('input[name="name"]', 'Mismatch Password User')
                ->type('input[name="email"]', 'mismatch@test.com')
                ->type('input[name="password"]', 'password123')
                ->type('input[name="password_confirmation"]', 'password456')  // Different
                ->select('select[name="role"]', 'admin')
                ->press('Tambah User')
                ->pause(2000)
                ->assertSee('The password field confirmation does not match');
        });
    }

    /**
     * Test 6: Validasi - Field name wajib diisi
     * @test
     */
    public function test_create_user_without_name_shows_error()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                // Don't fill name field - test HTML5 validation instead
                ->type('input[name="email"]', 'noname@test.com')
                ->type('input[name="password"]', 'password123')
                ->type('input[name="password_confirmation"]', 'password123')
                ->select('select[name="role"]', 'admin')
                ->screenshot('before_submit_empty_name');

            // Check if name field is required attribute
            $nameRequired = $browser->attribute('input[name="name"]', 'required');
            $this->assertNotNull($nameRequired, 'Name field should have required attribute');
        });
    }
}