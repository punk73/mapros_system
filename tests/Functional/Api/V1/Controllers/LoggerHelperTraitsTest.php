<?php

namespace App\Functional\Api\V1\Controllers;

use Hash;
use App\User;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use DB;

class mockDb {
    public function getQueryLog (){
        return [
            [
                'query' => 'insert into table values ( ?,?,?,? )',
                'bindings' => [
                    'teguh', '12', 'balonggandu', 'another column value'
                ], 
                'time' => ''
            ]
        ];
    }
}

class LoggerHelperTraitsTest extends TestCase
{
    use DatabaseMigrations;

    public function testLoggerHelperGetQueryParameter(){
        $loggerHelper = $this->getMockForTrait('App\Api\V1\Traits\LoggerHelper');
        // mockDb is class to mocking DB of laravel
        $mockDb = new mockDb;

        $expectedValue = "insert into table values ( teguh,12,balonggandu,another column value )";

        $result = $loggerHelper->getQueryParameter($mockDb);
        $this->assertSame($result, $expectedValue);

    }

    public function testPostLogMethodSuccess(){

        // cannot test this method yet since I cannot mock the loggerHelper->getQueryParameter yet.
        // the error below always shown
        // Trying to configure method "getQueryParameter" which cannot be configured because it does not exist, has not been specified, is final, or is static
    }


}
