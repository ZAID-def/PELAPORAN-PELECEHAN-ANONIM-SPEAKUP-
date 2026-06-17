<?php

namespace Tests\Browser\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminUpdateUserTest extends DuskTestCase
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
     * Test 1: UPDATE - Ubah role user dari admin ke super_admin
     * @test
     */
    public function test_super_admin_can_update_user_role_to_super_admin()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                // Find all role selects and change the one that's currently 'admin'
                ->script("
                    const selects = document.querySelectorAll('select[name=\"role\"]');
                    for (const select of selects) {
                        if (select.value === 'admin') {
                            select.value = 'super_admin';
                            select.form.submit();
                            break;
                        }
                    }
                ");

            $browser->pause(3000) // Wait for auto-submit and redirect
                ->assertSee('Peran user berhasil diperbarui');

            // Verify database change
            $this->assertDatabaseHas('users', [
                'id' => $this->regularAdmin->id,
                'role' => 'super_admin',
            ]);
        });
    }

    /**
     * Test 2: UPDATE - Ubah role dari super_admin ke admin
     * @test
     */
    public function test_super_admin_can_downgrade_user_role_to_admin()
    {
        // Create a super admin to downgrade
        $adminToDowngrade = User::create([
            'name' => 'Admin To Downgrade',
            'email' => 'downgrade@test.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
        ]);

        $this->browse(function (Browser $browser) use ($adminToDowngrade) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                // Find the second super_admin select (first one is current user which is disabled)
                ->script("
                    const selects = document.querySelectorAll('select[name=\"role\"]');
                    let superAdminSelects = [];
                    for (const select of selects) {
                        if (select.value === 'super_admin') {
                            superAdminSelects.push(select);
                        }
                    }
                    // Change the last super_admin (should be our created user)
                    if (superAdminSelects.length > 0) {
                        const lastSelect = superAdminSelects[superAdminSelects.length - 1];
                        lastSelect.value = 'admin';
                        lastSelect.form.submit();
                    }
                ");

            $browser->pause(3000) // Wait for auto-submit and redirect
                ->assertSee('Peran user berhasil diperbarui');

            // Verify database change
            $this->assertDatabaseHas('users', [
                'id' => $adminToDowngrade->id,
                'role' => 'admin',
            ]);
        });
    }

    /**
     * Test 3: UPDATE - User tidak bisa mengubah role diri sendiri
     * @test
     */
    public function test_user_cannot_change_own_role()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                // Check that current user's row shows static text instead of select
                ->assertSee('(Anda)')
                ->screenshot('own_user_row');
        });
    }
}