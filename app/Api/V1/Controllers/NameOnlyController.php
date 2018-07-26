<?php

namespace App\Api\V1\Controllers;

use Config;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Api\V1\Requests\NameRequest;
use App\Grade;
use App\Api\V1\Traits\LoggerHelper;
use DB;

class NameOnlyController extends Controller
{
    use LoggerHelper;

    protected $allowedParameter = [
        'name',
    ];

    protected $model = null;
    
    public function index(Request $request){
        $models = $this->model->select();
        $models = $this->filter($request, $models);
        return $models->paginate();
    }

    public function store(NameRequest $request ){
        $model = new $this->model;
        
        foreach ($request->only($this->allowedParameter) as $key => $value) {
            $model->$key = $value;
        }

        $model->save();

        $this->postLog($request, 'Create' );

        return [
            'success' => true,
            'data' => $model
        ];
    }

    public function update($id,Request $request){
        $model = $this->model->find($id);

        if ( is_null($model) || $model == null ) {
            return response()->json([
                'success' => false,
                'message' => 'model not found',
                'errors' => 'model not found',
                'status_code' => 422
            ], 422);
        }
        

        foreach ($request->only($this->allowedParameter) as $key => $value) {
            if ($value != null ) {
                $model->$key = $value;
            }
        }

        $model->save();

        $this->postLog($request, 'Update'  );
        
        return [
            'success' => true,
            'data' => $model
        ];
    }

    public function delete($id, Request $request){
        

        $model = $this->model->find($id);

        if ( is_null($model) || $model == null ) {
            return response()->json([
                'success' => false,
                'message' => 'model not found',
                'errors' => 'model not found',
                'status_code' => 422
            ], 422);
        }        

        $model->delete();

        $this->postLog($request, 'Delete' );
        

        return [
            'success' => true
        ];
    }

    private function filter(Request $request, $model ){
        $params = $request->only($this->allowedParameter);
        foreach ($params as $key => $param) {
            if (isset($params[$key]) && $param != '' ) {
                $model = $model->where($key, 'like', $param .'%' );
            }    
        }
        return $model;
    }

    public function show($id){
        $model = $this->model->find($id);
        if ( is_null($model) || $model == null ) {
            return response()->json([
                'success' => false,
                'message' => 'model not found',
                'errors' => 'model not found',
                'status_code' => 422
            ], 422);
        }
        
        return [
            'success' => true,
            'data' => $model
        ];
    }
}
