<?php

namespace App\Api\V1\Controllers;

use Config;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Sequence;
use App\Api\V1\Traits\CrudHelper;

class SequenceController extends Controller
{	
	use CrudHelper;
    // the controller should always have model var
	protected $model;

	protected $rules = [
		'name' => 'required',
		'line_id' => 'required|integer',
		'process' => 'required',
	];

	// the controller should always have allowedParameter
	protected $allowedParameter = [
		'name',
		'line_id',
		'process',
	];

	public function __construct(){
		$this->model = new Sequence;
	}
}
