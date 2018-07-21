<?php

namespace App\Api\V1\Controllers;

use Config;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Log;

class LogBasedController extends Controller
{
    protected $allowedParameters = [
    	'description',
    ];

    private function push(Array $args){
    	$log = new Log;
    	foreach ($args as $key => $value) {
    		// cek apakah key argument ada di log properties
    		if (in_array($key, $log->toArray() ) ) {
    			$log->$key = $value;
    		}
    	}
    	$log->save();
    }

    public function store(Array $args){
    	$arg = $this->getParameter($args);
    	$this->push($args);
    }

    private function getParameter(Array $args){
    	$paramters = [];
    	foreach ($args as $key => $value) {
    		if (in_array($key, $this->allowedParameters)) {
    			$paramters[$key] = $value;
    		}
    	}

    	return $paramters;
    }

}
