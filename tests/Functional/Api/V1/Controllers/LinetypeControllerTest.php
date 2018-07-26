<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use App\Linetype;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Traits\testHelper;

class LinetypeControllerTest extends TestCase
{
    use DatabaseMigrations,
        testHelper;

    protected $endpoint = 'api/linetypes/';

    protected $expectedJsonStructure = [
    	'data',
    	// 'success'
    ];

    protected $filterParameter = [
    	'name' => 'Digital Audio'
    ];

    protected $inputParameter = [
    	'name' => 'Digital Audio 03',
        'remark' => 'This line is processing digital audio products'
    ];

    protected $failedInputParameter = [
    	'notName' => 'klasdf'
    ];

    protected $putParameter = [
    	'name' => 'scanner name edited'
    ];

    public function __construct(){
        $this->model = new Linetype;
    }

}
