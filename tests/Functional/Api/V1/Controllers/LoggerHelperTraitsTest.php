<?php

namespace App\Functional\Api\V1\Controllers;

use Hash;
use App\User;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use DB;

class LoggerHelperTraitsTest extends TestCase
{
    use DatabaseMigrations;

    public function testLoggerHelperGetQueryParameter(){
        $mock = $this->getMockForTrait('App\Api\V1\Traits\LoggerHelper');
        $dbMock = $this->createMock(DB::class)
    }
}
