<?php

namespace App\Functional\Api\V1\Controllers;

use Config;
use App\TestCase;
use App\Line;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LineControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testReadAll(){
        $this->get('api/lines/')
        ->assertJsonStructure([
            'data'
        ])
        ->assertStatus(200);
    }

    public function testReadWithFileter(){
        $this->get('api/lines/', [
            'name' => 'line01',
            'process_type' => 'DA'
        ])
        ->assertJsonStructure([
            'data'
        ])
        ->assertStatus(200);
    }

    public function testPostSuccess(){
        $this->post('api/lines/', [
            'name' => 'line01',
            'process_type' => 'DA'  
        ])
        ->assertJsonStructure([
            'success',
            'data' => [
                'name',
                'process_type'
            ]
        ])
        ->assertStatus(200);
    }

    public function testPostWithoutProperParameter(){
        $this->post('api/lines/', [
            'name' => 'line01',
        ])
        ->assertJsonStructure([
            'success',
            'errors',
            'message',
            'status_code',
        ])
        ->assertStatus(422);   
    }

    public function testPut(){
        $this->addNewRecord();

        $this->put('api/lines/1', [
            'name' => 'line 1 edited'
        ])
        ->assertJsonStructure([
            'success',
            'data' => [
                'name',
                'process_type'       
            ]
        ])
        ->assertJson([
            'data' => [
                'name' => 'line 1 edited',
                'process_type' => 'DA'
            ]
        ])
        ->assertStatus(200);
    }

    private function addNewRecord(){
        $line = new Line;
        $line->name = 'dudududk';
        $line->process_type = 'DA';
        $line->save();
    }

    public function testDelete(){
        $this->addNewRecord();

        $model = Line::select(['id'])
        ->orderBy('id', 'desc')
        ->first();
        $this->assertEquals(1, count($model), 'pre conditions');

        $id = $model->id;
        $this->delete('api/lines/'.$id)
        ->assertJsonStructure([
            'success',
        ])
        ->assertJson([
            'success'=> true
        ])
        ->assertStatus(200);

        $model = Line::select(['id'])->first();
        $this->assertEquals(0, count($model), 'finish' );
    }

}
