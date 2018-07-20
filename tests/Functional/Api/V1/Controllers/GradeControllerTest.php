<?php

namespace App\Functional\Api\V1\Controllers;

use Config;
use App\TestCase;
use App\Grade;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GradeControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $endpoint = 'api/grades/';
    protected $model = null;

    public function __construct(){
        $this->model = new Grade;
    }

    public function testReadAll(){
        $this->get($this->endpoint)
        ->assertJsonStructure([
            'data'
        ])
        ->assertStatus(200);
    }

    public function testReadWithFileter(){
        $this->get($this->endpoint, [
            'name' => 'supervisor',
        ])
        ->assertJsonStructure([
            'data'
        ])
        ->assertStatus(200);
    }

    public function testPostSuccess(){
        $testCase = [
            'name' => 'supervisor'
        ];

        $this->post($this->endpoint, $testCase )
        ->assertJsonStructure([
            'success',
            'data'
        ])
        ->assertJson([
            'success' => true,
            'data' => $testCase  
        ])
        ->assertStatus(200);
    }

    public function testPostWithoutProperParameter(){
        $this->post($this->endpoint, [
            'notName' => 'test'
        ])
        ->assertJsonStructure([
            'success',
            'errors',
            'message',
            'status_code',
        ])
        ->assertStatus(422);   
    }

    public function testPutSuccess(){
        $this->addNewRecord();

        $model = $this->model->select(['id'])
        ->orderBy('id', 'desc')
        ->first();

        $id = $model->id;

        $this->assertEquals($id, !null , 'pre conditions');

        $this->put( $this->endpoint .$id, [
            'name' => 'supervisor edited'
        ])
        ->assertJsonStructure([
            'success',
            'data' => [
                'name'    
            ]
        ])
        ->assertJson([
            'success' => true,
            'data' => [
                'name' => 'supervisor edited'
            ]
        ])
        ->assertStatus(200);
    }

    public function testPutFailed(){

        $id = 995849;
        $isExists = $this->model->exists($id);

        $this->assertEquals($id, !null , 'pre conditions');
        $this->assertEquals($isExists, false , 'kalau ini exists, test case ini tidak benar.');


        $this->put( $this->endpoint .$id, [
            'name' => 'supervisor edited'
        ])
        ->assertJsonStructure([
            'success',
            'errors',
            'message',
            'status_code'
        ])
        ->assertStatus(422);
    }

    private function addNewRecord(){
        $model = $this->model;
        $model->name = 'dudududk';
        $model->save();
    }

    public function testDelete(){
        $this->addNewRecord();

        $model = $this->model->select(['id'])
        ->orderBy('id', 'desc')
        ->first();
        $this->assertEquals(1, count($model), 'pre conditions');

        $id = $model->id;
        $this->delete($this->endpoint.$id)
        ->assertJsonStructure([
            'success',
        ])
        ->assertJson([
            'success'=> true
        ])
        ->assertStatus(200);

        $model = $this->model->select(['id'])->first();
        $this->assertEquals(0, count($model), 'finish' );
    }

    public function testDeleteFailedBecauseDataNotFound(){
        $id = 995849;
        $isExists = $this->model->exists($id);

        $this->assertEquals($id, !null , 'pre conditions');
        $this->assertEquals($isExists, false , 'kalau ini exists, test case ini tidak benar.');

        $this->delete($this->endpoint.$id)
        ->assertJsonStructure([
            'success',
            'errors',
            'message',
            'status_code'
        ])
        ->assertJson([
            'success'=> false
        ])
        ->assertStatus(422);
    }

}
