<?php

namespace App\Api\V1\Traits;
use Tymon\JWTAuth\JWTAuth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Api\V1\Traits\LoggerHelper;

trait CrudHelper {

    use LoggerHelper;
	// the controller should always have model var
	// protected $model;

	// the controller should always have allowedParameter
	// protected $allowedParameter = [];
    
    public function index(Request $request){
        $models = $this->model->select();
        $models = $this->filter($request, $models);
        return $models->paginate();
    }

    public function store(Request $request ){
        $model = new $this->model;
        
        foreach ($request->only($this->allowedParameter) as $key => $value) {
            $model->$key = $value;
        }

        $model->save();

        $this->postLog($request, 'Create', $model->toSql());

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

        $this->postLog($request, 'Update', $model->toSql());
        
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

        $this->postLog($request, 'Delete', $model->toSql());

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