<?php

namespace App\Api\V1\Controllers;

use Config;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Scanner;
use App\Api\V1\Traits\CrudHelper;

class ScannerController extends Controller
{	
	use CrudHelper;
    // the controller should always have model var
	protected $model;

	protected $rules = [
		'line_id' => 'required',
		'lineprocess_id' => 'required', 
		'name' => 'required', 
		'mac_address' => 'required',
		'ip_address' => 'required'
	];
	// the controller should always have allowedParameter
	protected $allowedParameter = [
		'line_id', 'lineprocess_id', 'name', 'mac_address','ip_address'
	];

	public function __construct(){
		$this->model = new Scanner;
	}
}
