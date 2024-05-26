<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ManagePostTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    use RefreshDatabase;
    /** @test */
    public function user_can_create_a_post()
    {
        set_time_limit(0);
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $browser->actingAs($user)->visit('/stok')->press('tambahDataStok')
                ->whenAvailable('.modal', function ($modal) {
                    $modal->submitForm('Submit', [
                        'jenisAyam' => 'Ayam',
                        'deskripsi' => 'Anak ayam yang baik hati', // publish
                        'hargaJual' => 11000
                    ]);
                });
            $browser->seeInDatabase('stok_ayams', [
                'jenisAyam' => 'Ayam',
                'deskripsi' => 'Anak ayam yang baik hati',
                'hargaJual' => 11000
            ]);
            $browser->seePageIs('/stok');
            $browser->see('Ayam'); // ini titlenya
            $browser->see(11000); // ini statusnya
        });
    }



    // ter-redirect ke halaman daftar post


    /** @test */
    public function user_can_browse_posts_index_page()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function user_can_edit_existing_post()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function user_can_delete_existing_post()
    {
        $this->assertTrue(true);
    }
}
