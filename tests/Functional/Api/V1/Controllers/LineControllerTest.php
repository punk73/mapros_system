<?php

namespace App\Functional\Api\V1\Controllers;

use Config;
use App\TestCase;
use App\Line;
use App\Log;
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

        // fwrite(STDOUT, var_dump($this->token));
        // fwrite(STDOUT, 'I am line controller test');
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

        $logCountBefore = Log::all()->count();
        $this->assertTrue(($logCountBefore === 0), ' testing that log still 0');

        $this->post('api/lines/', [
            'name' => 'line01',
            'linetype_id' => 1,
            'remark' => 'some remark here'  
        ])
        ->assertJson([
            'success' => true
        ])
        ->assertJsonStructure([
            'success',
            'data' => [
                'name',
                'remark',
                'linetype_id'
            ]
        ])
        ->assertStatus(200);

        $logCountAfter = Log::all()->count();
        $this->assertTrue(($logCountAfter > $logCountBefore), 'testing that log has increase' );

    }

    public function testPostWithoutProperParameter(){
        $this->post('api/lines/', [
            'notName' => 'line01', //it should fail because name not being passed by client
        ])
        ->assertJsonStructure([
            'success',
            // 'errors',
            'message',
            'status_code',
        ])
        ->assertStatus(500);   
    }

    public function testPut(){

        $this->addNewRecord();
        
        $logCountBefore = Log::all()->count();
        $this->assertTrue(($logCountBefore === 0), ' testing that log still 0');
        

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

        $logCountAfter = Log::all()->count();
        $this->assertTrue(($logCountAfter > $logCountBefore), 'testing that log has increase' );

    }

    private function addNewRecord(){
        $line = new Line;
        $line->name = 'dudududk';
        $line->remark = 'DA';
        $line->linetype_id = 1;
        $line->save();
    }

    public function testDelete(){
        $this->addNewRecord();

        $model = Line::select(['id'])
        ->orderBy('id', 'desc')
        ->first();

        $logCountBefore = Log::all()->count();
        $this->assertTrue(($logCountBefore === 0), ' testing that log still 0');

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

        $logCountAfter = Log::all()->count();
        $this->assertTrue(($logCountAfter > $logCountBefore), 'testing that log has increase' );
    }

}
