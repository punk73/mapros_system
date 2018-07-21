<?php

namespace App;

use Hash;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function addUser(){
        $user = new User([
            'name' => 'Test',
            'email' => 'test@email.com',
            'password' => '123456',
            'nik' => '393870',
        ]);

        $user->save();
    }

    protected function login($user_id = 1){   
        $this->addUser();

        $user = User::find($user_id);
        $this->token = JWTAuth::fromUser($user);

        JWTAuth::setToken($this->token);

        Auth::login($user);
    }
}
