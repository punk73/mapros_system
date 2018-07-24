<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use App\Scanner;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Traits\testHelper;

class BasedControllerTest extends TestCase
{
    use DatabaseMigrations;
    use testHelper;

    protected $endpoint = 'api/scanners/';

    protected $expectedJsonStructure = [
    	'data',
    	// 'success'
    ];

    protected $filterParameter = [
    	'name' => 'Scanner'
    ];

    protected $inputParameter = [
    	'sequence_id' => 10,
    	'name' => 'Scanner 03',
    	'mac_address' => '3C:FC:92:34:10:F5',
    	'ip_address' => '16.162.125.87'
    ];

    protected $failedInputParameter = [
    	'notName' => 'klasdf'
    ];

    protected $putParameter = [
    	'name' => 'scanner name edited'
    ];

    public function __construct(){
        $this->model = new Scanner;
    }

}
