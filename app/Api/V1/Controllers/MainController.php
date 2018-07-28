<?php

namespace App\Api\V1\Controllers;

use Config;
use App\Board;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\BoardRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Api\V1\Traits\LoggerHelper;
use SplDoublyLinkedList as Node;

class BoardController extends Controller
{
    use LoggerHelper;

    public function __construct (){
        $this->model = new Board;
    }

    protected $allowedParameter = [
        'board_id',
        'nik',
        'ip',
        'is_solder'
    ];



    public function store(BoardRequest $request ){
    	// cek apakah board id atau ticket;
        
        // jika board id, kita kerja di table boards;

        // cek data scanner, yaitu scanner yang memiliki ip yg dikirim client ( $request->ip() )
    	
        // if is_solder == true, maka cek data di table boards based on boad id & scanner_id

    }
    
    
}
