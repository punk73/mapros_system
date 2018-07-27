<?php

namespace App\Api\V1\Controllers;

use Config;
use App\Connection;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LineRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Api\V1\Traits\CrudHelper;

class ConnectionController extends Controller
{
    use CrudHelper;

    public function __construct (){
        $this->model = new Connection;
    }

    protected $allowedParameter = [
        'db_connection',
        'db_host',
        'db_port',
        'db_name',
        'db_username',
        'db_password',
    ];
    
    
}
