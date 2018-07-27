<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use App\Endpoint;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Traits\testHelper;

class EndpointControllerTest extends TestCase
{
    use DatabaseMigrations,
        testHelper;

    protected $endpoint = 'api/endpoints/';

    protected $expectedJsonStructure = [
    	'data',
    	// 'success'
    ];

    protected $filterParameter = [
    	'name' => 'Scanner'
    ];

    protected $inputParameter = [
    	'name' => 'AOI',
        'url' => 'http://localhost/public/api/aois'
    ];

    protected $failedInputParameter = [
    	'notName' => 'klasdf'
    ];

    protected $putParameter = [
    	'name' => 'Aoi edited'
    ];

    public function __construct(){
        $this->model = new Endpoint;
    }

}
