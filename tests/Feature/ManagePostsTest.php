<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagePostsTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_create_a_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->visit('/stok')->press('tambahDataStok');

        // user isi `title`, publish status dan content,
        // lalu klik tombol save
        $this->submitForm('Submit', [
            'jenisAyam' => 'Ayam',
            'deskripsi' => 'Anak ayam yang baik hati', // publish
            'hargaJual' => 11000
        ]);

        // lihat data post di database
        $this->seeInDatabase('stok_ayams', [
            'jenisAyam' => 'Ayam',
            'deskripsi' => 'Anak ayam yang baik hati',
            'hargaJual' => 11000
        ]);

        // ter-redirect ke halaman daftar post
        $this->seePageIs('/stok');

        // lihat post yang sudah diinput
        $this->see('Ayam'); // ini titlenya
        $this->see(11000); // ini statusnya
    }

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
