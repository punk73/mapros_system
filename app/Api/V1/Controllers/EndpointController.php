<?php

namespace App\Api\V1\Controllers;

use Config;
use App\Endpoint;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LineRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Api\V1\Traits\CrudHelper;

class EndpointController extends Controller
{
    use CrudHelper;

    public function __construct (){
        $this->model = new Endpoint;
    }

    protected $allowedParameter = [
        'name',
        'url'
    ];
    
    
}
