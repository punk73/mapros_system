<?php

namespace App\Api\V1\Traits;
use Tymon\JWTAuth\JWTAuth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait CrudHelper {

	protected $model;

	public function __construct(Model $model){
		$this->model = $model;
	}

	public function index($id, Request $request ){
		return $this->model->all();
	}

	public function store(Request $request){

	}

	public function update($id, Request $request ){

	}

	public function delete($id, Request $request ){

	}

}