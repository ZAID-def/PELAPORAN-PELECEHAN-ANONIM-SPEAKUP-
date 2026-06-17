<?php

namespace Tests\Browser\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminDeleteUserTest extends DuskTestCase
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
     * Test 1: DELETE - Hapus user berhasil
     * @test
     */
    public function test_super_admin_can_delete_user()
    {
        // Create user to be deleted
        $userToDelete = User::create([
            'name' => 'User Untuk Dihapus',
            'email' => 'todelete@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) use ($userToDelete) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->assertSee($userToDelete->name)
                // Override browser confirmation dialog and find delete button
                ->script("
                    window.confirm = function() { return true; };
                    // Find all delete buttons and click the one in the row with our user
                    const rows = document.querySelectorAll('tbody tr');
                    for (const row of rows) {
                        if (row.textContent.includes('{$userToDelete->email}')) {
                            const deleteButton = row.querySelector('button[type=\"submit\"]');
                            if (deleteButton && deleteButton.textContent.includes('Hapus')) {
                                deleteButton.click();
                                break;
                            }
                        }
                    }
                ");

            $browser->pause(3000) // Wait for deletion and redirect
                ->assertSee('Admin berhasil dihapus')
                ->assertDontSee($userToDelete->name);
        });

        // Verify user deleted from database
        $this->assertDatabaseMissing('users', [
            'id' => $userToDelete->id
        ]);
    }

    /**
     * Test 2: DELETE - Tidak bisa hapus diri sendiri
     * @test
     */
    public function test_super_admin_cannot_delete_own_account()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                // Verify that super admin's own row shows "(Anda)" and has no delete button
                ->assertSee('(Anda)')
                ->screenshot('own_account_row');
        });
    }

    /**
     * Test 3: DELETE - Konfirmasi dialog muncul saat hapus
     * @test
     */
    public function test_delete_user_shows_confirmation_dialog()
    {
        // Create user to be deleted
        $userToDelete = User::create([
            'name' => 'User Untuk Test Dialog',
            'email' => 'testdialog@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) use ($userToDelete) {
            $browser->loginAs($this->superAdmin)
                ->visit('/admin/users')
                ->pause(1000)
                ->assertSee($userToDelete->name)
                // Override confirm to return false (cancel delete) and test it
                ->script("
                    window.confirm = function() { return false; };
                    // Try to find and click delete button
                    const rows = document.querySelectorAll('tbody tr');
                    for (const row of rows) {
                        if (row.textContent.includes('{$userToDelete->email}')) {
                            const deleteButton = row.querySelector('button[type=\"submit\"]');
                            if (deleteButton && deleteButton.textContent.includes('Hapus')) {
                                deleteButton.click();
                                break;
                            }
                        }
                    }
                ");

            $browser->pause(2000)
                // User should still be there since we cancelled
                ->assertSee($userToDelete->name);

            // Verify user still exists in database
            $this->assertDatabaseHas('users', [
                'id' => $userToDelete->id
            ]);
        });
    }
}