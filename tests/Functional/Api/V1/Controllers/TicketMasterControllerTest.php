<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use App\Ticket_masters;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Traits\testHelper;

class TicketMasterControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $endpoint = 'api/ticket_masters/';

    public function __construct(){
        $this->model = new Ticket_masters;
    }

    protected $expectedJsonStructure = [
        'data',
    ];

    protected $inputParameter = [
        'code' => 'PLN',
        'line_id' => 1,
        'count' => 1
    ];

    protected $failedInputParameter = [
        'notName' => 'klasdf'
    ];

    public function testPostSuccess (){
        $result = $this->post($this->endpoint, $this->inputParameter );
        $result->assertJsonStructure([
            'success',
            'data'
        ])->assertJson([
            'success' => true
        ]);
    }

    public function testReturnValueCorrect(){
        $this->inputParameter['count'] = 5;
        $result = $this->post($this->endpoint, $this->inputParameter );
        $returnValue = $result->original;
        $generatedCode = 'PLN00100001';
        // fwrite(STDOUT, var_dump( $returnValue ) );
        $this->assertEquals(count($returnValue['data']), ($this->inputParameter['count']+1) );
        $this->assertEquals( $returnValue['data'][0], $generatedCode );
    }


}
