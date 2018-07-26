<?php

namespace App\Api\V1\Controllers;

use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Api\V1\Requests\TicketRequest;
use App\Ticket;

class TicketController extends Controller
{	
	public function __construct(){
		$this->model = new Ticket;
	}

	protected $allowedParameter = [
		'line_id',
		'code',
		'count'
	];

	public function store(TicketRequest $request){

		// cek if ilne_id & code exists on table;
		$ticket = Ticket::where('line_id', $request->line_id )
		->where('code', $request->code )
		->orderBy('id', 'desc');

		if (!$ticket->exists()) {
			// jika null, create with last_no = 1;
			$request->last_no = 1;
			$result = $this->insertTicket($request);
			$result = $this->encode($result, 1, $request->count );
		}else{
			// else, crate with last_no++;
			$firstTicket = $ticket->first();
			$result = $this->updateTicket($firstTicket, $request->count );
			$result = $this->encode($result, $firstTicket['last_no'] , $request->count );
			
		}
		// return $result;


		return [
			'success' => true,
			'data' => $result
		];
	}

	private function insertTicket(TicketRequest $request){
		$newTicket = new Ticket;
		$newTicket->line_id = $request->line_id;
		$newTicket->code = $request->code;
		$newTicket->last_no = $request->last_no;
		$newTicket->save();

		return $newTicket;
	}

	private function updateTicket(Ticket $ticket, $count = 1 ){
		$ticket->last_no = $ticket->last_no + $count ;
		$ticket->save();

		return $ticket;
	}

	private function encode(Ticket $ticket, $start=1 ,$count = 1 ){
		$arrayResult = [];
		for ($i=$start; $i <= ($start+$count) ; $i++) { 
			$code = $ticket->code;
			$line_id = str_pad($ticket->line_id,3,0,STR_PAD_LEFT);
			$last_no = str_pad( $i ,5,0,STR_PAD_LEFT);
			$arrayResult[] = $code . $line_id . $last_no;
		}
		return $arrayResult;
	}

	private function decode(){

	}
}
