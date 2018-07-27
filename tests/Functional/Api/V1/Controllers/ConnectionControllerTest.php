<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use App\Connection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Traits\testHelper;

class ConnectionControllerTest extends TestCase
{
    use DatabaseMigrations,
        testHelper;

    protected $endpoint = 'api/connections/';

    protected $expectedJsonStructure = [
    	'data',
    	// 'success'
    ];

    protected $filterParameter = [
    	'name' => 'Scanner'
    ];

    protected $inputParameter = [
    	'db_connection' => 10,
    	'db_host' => 'Scanner 03',
    	'db_port' => '3C:FC:92:34:10:F5',
    	'db_name' => '16.162.125.87',
        'db_username'=>'username',
        'db_password'=> 'test',
    ];

    protected $failedInputParameter = [
    	'notName' => 'klasdf'
    ];

    protected $putParameter = [
    	'db_port' => '8080'
    ];

    public function __construct(){
        $this->model = new Connection;
    }

}
