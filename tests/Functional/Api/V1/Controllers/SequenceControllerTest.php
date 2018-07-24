<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use App\Scanner;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Traits\testHelper;

class SequenceControllerTest extends TestCase
{
    use DatabaseMigrations;
    use testHelper;

    protected $endpoint = 'api/sequences/';

    protected $expectedJsonStructure = [
    	'data',
    ];

    protected $filterParameter = [
    	'name' => 'Scanner'
    ];

    protected $inputParameter = [
    	'name' => 'squence 02',
    	'line_id' => 2,
    	'lineprocess_id' => 2,
        'lineprocess_id_before' => 1,
    ];

    protected $failedInputParameter = [
    	'notName' => 'klasdf'
    ];

    protected $putParameter = [
    	'name' => 'squence 02'
    ];

    public function __construct(){
        $this->model = new Scanner;
    }

}
