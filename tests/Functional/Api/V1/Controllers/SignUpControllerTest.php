<?php

namespace App\Functional\Api\V1\Controllers;

use Config;
use App\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SignUpControllerTest extends TestCase
{
    //use DatabaseMigrations is already set by TestCase

    public function testSignUpSuccessfully()
    {
        $this->post('api/auth/signup', [
            'name' => 'Test User',
            'email' => 'new_email@email.com',
            'password' => '123456',
            'nik' => 39597,
        ])->assertJson([
            'status' => 'ok'
        ])->assertStatus(201);
    }

    public function testSignUpSuccessfullyWithTokenRelease()
    {
        Config::set('boilerplate.sign_up.release_token', true);

        $this->post('api/auth/signup', [
            'name' => 'Test User',
            'email' => 'new_email@email.com',
            'password' => '123456',
            'nik' => 39597
        ])->assertJsonStructure([
            'status', 'token'
        ])->assertJson([
            'status' => 'ok'
        ])->assertStatus(201);
    }

    public function testSignUpReturnsValidationError()
    {
        $this->post('api/auth/signup', [
            'name' => 'Test User',
            'email' => 'test@email.com'
        ])->assertJsonStructure([
            'errors'
        ])->assertStatus(422);
    }
}
