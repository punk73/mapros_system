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
		'guid_master',
		'guid_ticket',
		'scanner_id',
		'status',
		'scan_nik',
		'judge',
    ];

    public function store(BoardRequest $request ){
    	// buat new node

    	// cek apakah sudah ada process sebelumnya.

    }
    
    
}
