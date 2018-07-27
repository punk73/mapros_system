<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use App\Lineprocess;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Traits\testHelper;

class LineprocessControllerTest extends TestCase
{
    use DatabaseMigrations,
        testHelper;

    protected $endpoint = 'api/lineprocesses/';

    protected $expectedJsonStructure = [
    	'data',
    	// 'success'
    ];

    protected $filterParameter = [
    	'name' => 'proses input 1'
    ];

    protected $inputParameter = [
    	'name' => 'Scanner 03',
        'connection_id' => 1
    ];

    protected $failedInputParameter = [
    	'notName' => 'klasdf'
    ];

    protected $putParameter = [
    	'name' => 'process 1'
    ];

    public function __construct(){
        $this->model = new Lineprocess;
    }

}
