<?php

namespace App\Api\V1\Controllers;

use Config;
use Tymon\JWTAuth\JWTAuth;
use App\Api\V1\Controllers\NameOnlyController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Access;

class AccessController extends NameOnlyController
{
    public function __construct(){
        $this->model = new Access;
    }
}
