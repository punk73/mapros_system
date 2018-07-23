<?php

namespace App\Functional\Api\V1\Controllers;

use Hash;
use App\User;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $expectedErrorJsonFormat = [
        'errors',
        'success',
        'message',
        'status_code',    
    ];

    public function setUp()
    {
        parent::setUp();

        $user = new User([
            'name' => 'Test',
            'email' => 'test_login_email@email.com',
            'password' => '123456',
            'nik' => '54845',
        ]);

        $user->save();
    }

    public function tearDown(){
        // this method called after each test
        $user = User::truncate();
        // below code is to console log
        // fwrite(STDERR, 'tearDown called!');
    }

    public function testLoginSuccessfully()
    {
        $this->post('api/auth/login', [
            'email' => 'test_login_email@email.com',
            'password' => '123456'
        ])->assertJson([
            'status' => 'ok'
        ])->assertJsonStructure([
            'status',
            'token'
        ])->isOk();
    }

    public function testLoginWithReturnsWrongCredentialsError()
    {
        $this->post('api/auth/login', [
            'email' => 'unknown@email.com',
            'password' => '123456'
        ])->assertJsonStructure([
            'success',
            'message',
            'status_code',    
        ])
        ->assertStatus(403);
    }

    public function testLoginWithReturnsValidationError()
    {
        $this->post('api/auth/login', [
            'email' => 'test_login_email@email.com'
        ])->assertJsonStructure($this->expectedErrorJsonFormat)
        ->assertStatus(422);
    }
}
