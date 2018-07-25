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
        // configure the stub
        /*$dbMock = $this->createMock(DB::class);
        $dbMock->expects($this->any())
        ->method('getQueryLog')
        ->willReturn($returnValue);*/
        $expectedValue =[
            'query' => 'insert into table values ( ?,?,?,? )',
            'bindings' => [
                'teguh', '12', 'balonggandu', 'another column value'
            ], 
            'time' => ''
        ];

        $test = [
            'getQueryLog' => function (){
                return [
                    'query' => 'insert into table values ( ?,?,?,? )',
                    'bindings' => [
                        'teguh', '12', 'balonggandu', 'another column value'
                    ], 
                    'time' => ''
                ];
            }
        ];
        fwrite(STDOUT, var_dump($test));
        // $result = $mock->getQueryParameter($this->generateMockDbClass());
        // fwrite(STDOUT, var_dump($result));
        // $this->assertSame($result , $expectedValue );


    }


}
