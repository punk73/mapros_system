<?php

namespace App\Api\V1\Traits;
use Tymon\JWTAuth\JWTAuth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Api\V1\Traits\LoggerHelper;
use DB;

trait CrudHelper {

    use LoggerHelper;
	// the controller should always have model var
	// protected $model;

	// the controller should always have allowedParameter
	// protected $allowedParameter = [];
    
    public function index(Request $request){
        $limit = (isset($request->limit)) ? $request->limit : 15 ;

        $models = $this->model->select();
        $models = $this->filter($request, $models);
        return $models->paginate($limit);
    }

    public function store(Request $request ){
        DB::enableQueryLog();
        /*you are doing it */
        $rules = (isset($this->rules)) ? $this->rules : [];
        $this->validate($request, $rules );
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
        DB::enableQueryLog();
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

        $this->postLog($request, 'Update');
        
        return [
            'success' => true,
            'data' => $model
        ];
    }

    public function delete($id, Request $request){
        DB::enableQueryLog();
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

        $this->postLog($request, 'Delete');

        return [
            'success' => true
        ];
    }

    private function filter(Request $request, $model ){
        $params = $request->only($this->allowedParameter);
        $table = $this->model->getTable();
        $tableColumns = DB::getSchemaBuilder()->getColumnListing($table);
        // return $params;
        foreach ($params as $key => $param) {
            if ( in_array($key, $tableColumns )  && $param != '' ) {
                
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