<?php

namespace App\Api\V1\Controllers;

use Config;
use App\Line;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LineRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;

class LineController extends Controller
{
    protected $allowedParameter = [
        'name',
        'process_type'
    ];
    
    public function index(Request $request){
        $lines = Line::select();
        $lines = $this->filter($request, $lines);
        return $lines->paginate();
    }

    public function store(LineRequest $request ){
        $line = new Line;
        
        foreach ($request->only($this->allowedParameter) as $key => $value) {
            $line->$key = $value;
        }

        $line->save();

        return [
            'success' => true,
            'data' => $line
        ];
    }

    public function update($id,Request $request){
        $line = Line::find($id);

        $this->checkNull($line);

        foreach ($request->only(['name', 'process_type']) as $key => $value) {
            if (isset($key) && $value !== null ) {
                $line->$key = $value;
            }
        }

        $line->save();

        return [
            'success' => true,
            'data' => $line
        ];
    }

    public function delete($id){
        $line = Line::find($id);

        $this->checkNull($line);

        $line->delete();

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

    private function checkNull($model){
        if (is_null($model)) {
            return response()->json([
                'success' => false,
                'message' => 'Line not found',
                'errors' => 'line not found',
                'status_code' => 422
            ], 422);
        }
    }
}
