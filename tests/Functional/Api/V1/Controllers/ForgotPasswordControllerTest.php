<?php

namespace App\Functional\Api\V1\Controllers;

use App\User;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ForgotPasswordControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $user = new User([
            'name' => 'Test',
            'email' => 'test@email.com',
            'password' => '123456',
            'nik' => 39597
        ]);

        $user->save();
    }

    public function tearDown(){
        User::truncate();
    }

    public function testForgotPasswordRecoverySuccessfully()
    {
        $this->post('api/auth/recovery', [
            'email' => 'test@email.com'
        ])->assertJson([
            'status' => 'ok'
        ])->isOk();
    }

    public function testForgotPasswordRecoveryReturnsUserNotFoundError()
    {
        $this->post('api/auth/recovery', [
            'email' => 'unknown@email.com'
        ])->assertJsonStructure([
            'success',
            'message'
        ])->assertStatus(404);
    }

    public function testForgotPasswordRecoveryReturnsValidationErrors()
    {
        $this->post('api/auth/recovery', [
            'email' => 'i am not an email'
        ])->assertJsonStructure([
            'success',
            'message'
        ])->assertStatus(422);
    }
}
