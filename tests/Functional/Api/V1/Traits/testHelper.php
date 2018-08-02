<?php
namespace App\Functional\Api\V1\Traits;

trait testHelper {
    /*
        expectedJsonStructure is array that used to assert json structure of test read, read filter,
    */
    // protected $expectedJsonStructure;

    // protected $filterParameter;
    // protected $inputParameter;

    public function testReadAll(){
        $this->get($this->endpoint)
        ->assertJsonStructure($this->expectedJsonStructure)
        ->assertStatus(200);
    }

    public function testReadWithLimitSpecify(){
        
        $limit = 3;

        $ajax = $this->get($this->endpoint, [
            'limit' => $limit 
        ]);

        $result = $ajax->original;
        // cek result data 3;
        //assertLessThanOrEqual($expected, $actual ) 
        $this->assertLessThanOrEqual($limit, count($result['data']) );
    }

    public function testReadWithFilter(){
        $response = $this->get($this->endpoint, $this->filterParameter );

        $response->assertJsonStructure(
            $this->expectedJsonStructure
        )
        ->assertStatus(200);        
    }

    public function testReadWithFilterSuccess (){
        if (method_exists($this, 'seedDb')) {
            $this->seedDb();

            $this->get($this->endpoint, $this->filterParameter )
            ->assertJson([
                'data' => [
                    
                ]
            ]);
            
        }
    }

    public function testPostSuccess(){

        $this->post($this->endpoint, $this->inputParameter )
        ->assertJsonStructure([
            'success',
            'data'
        ])
        ->assertJson([
            'success' => true,
            'data' => $this->inputParameter  
        ])
        ->assertStatus(200);
    }

    public function testPostWithoutProperParameter(){
        $this->post($this->endpoint, $this->failedInputParameter )
        ->assertJsonStructure([
            'success',
            // 'errors', //it can't be achieve now
            'message',
            'status_code',
        ])
        ->assertStatus(500);   
    }

    public function testPutSuccess(){
        $this->addNewRecord();

        $model = $this->model->select(['id'])
        ->orderBy('id', 'desc')
        ->first();

        $id = $model->id;

        $this->assertEquals($id, !null , 'pre conditions');

        $this->put( $this->endpoint .$id, $this->putParameter )
        ->assertJsonStructure([
            'success',
            'data'
        ])
        ->assertJson([
            'success' => true,
            'data' => $this->putParameter
        ])
        ->assertStatus(200);
    }

    public function testPutFailed(){

        $id = 995849;
        $isExists = $this->model->exists($id);

        $this->assertEquals($id, !null , 'pre conditions');
        $this->assertEquals($isExists, false , 'kalau ini exists, test case ini tidak benar.');


        $this->put( $this->endpoint .$id, $this->putParameter )
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
        foreach ($this->inputParameter as $key => $value) {
            $model->$key = $value;
        }
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