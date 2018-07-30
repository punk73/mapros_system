<?php

/**
 * 
 */
namespace App\Api\V1\Helper;
use App\Model;
use App\Board;
use App\Ticket;
use App\Scanner;

class Node
{
	protected $model;
	protected $ticketCriteria = [
		'MST', 'PNL', 'MCH'
	];
	protected $allowedParameter = [
		'board_id',
        'nik',
        'ip',
        'is_solder'
	];

	public $scanner_id;
	public $dummy_id; //it could be ticket_no, board_id, ticket_no_master based on the model
	public $guid_master;
	public $guid_ticket;
	public $status;
	public $judge = 'OK';
	public $nik;

	function __construct($parameter)
	{	
		// setup model
		$this->setModel($parameter);
		// setup scanner_id;
		$ip = $parameter['ip'];
		$this->setScannerId($ip);
		// setup nik
		$this->nik = $parameter['nik'];
		// setup board_id
		$this->dummy_id = $parameter['board_id'];
	}

	public function __toString(){
		return json_encode( [
			'scanner_id' => $this->scanner_id,
			'dummy_id' => $this->dummy_id,
			'guid_master' => $this->guid_master,
			'guid_ticket' => $this->guid_ticket,
			'status' => $this->status,
			'judge' => $this->judge,
			'nik' => $this->nik,
		]);
	}

	public function setScannerId($scanner_ip){
		$scanner = (Scanner::where('ip_address', $scanner_ip )->exists()) ? Scanner::where('ip_address', $scanner_ip )->first() : null ;
		$this->scanner_id = $scanner['id'];
	}

	private function setModel($parameter){
		$code = substr($parameter['board_id'], 0, 3);
		// setup which model to work with
		if (in_array($code, $this->ticketCriteria )) {
			// it is ticket, so we work with ticket
			if($code == 'MST'){
				$this->model = Master::class;
			}else {
				$this->model = Ticket::class;
			}
		}else {
			// it is a board, we working with board;
			$this->model = Board::class;
		}
	}




}