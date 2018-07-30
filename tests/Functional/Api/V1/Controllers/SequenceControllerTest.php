<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use App\Sequence;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Traits\testHelper;

class SequenceControllerTest extends TestCase
{
    use DatabaseMigrations;
    use testHelper;

    protected $endpoint = 'api/sequences/';

    public function __construct(){
        $this->model = new Sequence;
    }
    
    protected $expectedJsonStructure = [
        'data',
    ];

    protected $filterParameter = [
        'name' => 'Sequence'
    ];

    protected $inputParameter = [
        'name' => 'squence 02',
        'line_id' => 2,
        'process' => "1,2,3,4,5",
        
    ];

    protected $failedInputParameter = [
        'notName' => 'klasdf'
    ];

    protected $putParameter = [
        'name' => 'squence 02'
    ];


}
