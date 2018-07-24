<?php

namespace App\Api\V1\Controllers;

use Config;
use App\Line;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LineRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Api\V1\Traits\CrudHelper;

class LineController extends Controller
{
    use CrudHelper;

    public function __construct (){
        $this->model = new Line;
    }

    protected $allowedParameter = [
        'name',
        'remark',
        'input_by',
        'update_by',
    ];
    
    
}
