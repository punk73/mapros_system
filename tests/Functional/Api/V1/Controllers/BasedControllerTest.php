<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use App\Scanner;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Functional\Api\V1\Traits\testHelper;
use Illuminate\Support\Facades\Artisan;

class BasedControllerTest extends TestCase
{
    use DatabaseMigrations,
        testHelper;

    protected $endpoint = 'api/scanners/';

    protected $expectedJsonStructure = [
    	'data',
    	// 'success'
    ];

    protected $filterParameter = [
    	'name' => 'Scanner'
    ];

    public function seedDb(){
        // it's mean to seed the db for testing purpose;
        // Artisan::call('migrate:refresh');
        Artisan::call('db:seed', ['--class'=>'ScannerSeeder'] );
    }

    protected $inputParameter = [
    	'line_id' => 1,
        'lineprocess_id'=>1,
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
