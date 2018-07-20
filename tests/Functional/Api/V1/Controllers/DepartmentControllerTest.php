<?php

namespace App\Functional\Api\V1\Controllers;

use App\Functional\Api\V1\Controllers\GradeControllerTest;
use App\Department;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DepartmentControllerTest extends GradeControllerTest
{
    use DatabaseMigrations;

    protected $endpoint = 'api/departments/';
    protected $model;

    public function __construct(){
        $this->model = new Department;
    }
}
