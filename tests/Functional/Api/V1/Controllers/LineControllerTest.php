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
            'data',
        ])
        ->assertStatus(200);

        fwrite(STDOUT, var_dump($this->token));
        fwrite(STDOUT, 'I am line controller test');
    }

    public function testReadWithFileter(){
        $this->get('api/lines/', [
            'name' => 'line01',
            'remark' => 'DA'
        ])
        ->assertJsonStructure([
            'data'
        ])
        ->assertStatus(200);
    }

    public function testPostSuccess(){
        $this->post('api/lines/', [
            'name' => 'line01',
            'remark' => 'some remark here'  
        ])
        ->assertJson([
            'success' => true
        ])
        ->assertJsonStructure([
            'success',
            'data' => [
                'name',
                'remark'
            ]
        ])
        ->assertStatus(200);
    }

    public function testPostWithoutProperParameter(){
        $this->post('api/lines/', [
            'notName' => 'line01', //it should fail because name not being passed by client
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
                'remark'       
            ]
        ])
        ->assertJson([
            'data' => [
                'name' => 'line 1 edited',
            ]
        ])
        ->assertStatus(200);
    }

    private function addNewRecord(){
        $line = new Line;
        $line->name = 'dudududk';
        $line->remark = 'DA';
        $line->save();
    }

    public function testDelete(){
        $this->addNewRecord();

        $model = Line::select(['id'])
        ->orderBy('id', 'desc')
        ->first();

        $this->assertEquals(1, count($model), 'pre conditions');
        $id = $model->id;
        $this->assertEquals(!null, $id, 'cek that id not null' );

        $this->delete('api/lines/'.$id)
        ->assertJsonStructure([
            'success',
        ])
        ->assertJson([
            'success'=> true
        ])
        ->assertStatus(200);

        $model = Line::find($id);

        $this->assertEquals(0, count($model), 'finish' );
    }

}
