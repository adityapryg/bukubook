<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_register_page_is_accessible(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSeeText("Register");
    }

    public function test_new_user_can_register()
    {
        //truncate/hapus data di tabel user
        //asd
        //register user
        $response = $this->post('/register', [
            'name' => 'Aditya Prayoga',
            'email' => 'aditya@brainmatics.com',
            'password' => 'strongpassword',
            'password_confirmation' => 'strongpassword'
        ]);
        //check user sudah ada di database
        $this->assertTrue(User::whereEmail("aditya@brainmatics.com")->exists());
        //berhasil authentikasi
        $this->assertAuthenticated();  //berhasil logins
        //postcondition diarahkan ke /home
        $response->assertRedirect('/home');
    }
}
