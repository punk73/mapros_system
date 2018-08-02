<?php

/**
 * 
 */
namespace App\Api\V1\Helper;
use App\Model;
use App\Board;
use App\Ticket;
use App\Scanner;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
	protected $dummy_column;

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
		return json_encode([
			'scanner_id' 	=> $this->scanner_id,
			'dummy_id' 		=> $this->dummy_id,
			'guid_master' 	=> $this->guid_master,
			'guid_ticket' 	=> $this->guid_ticket,
			'status' 		=> $this->status,
			'judge' 		=> $this->judge,
			'nik' 			=> $this->nik,
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
				$this->model = new Master;
				$this->dummy_column = 'ticket_no_master';
			}else {
				$this->model = new Ticket;
				$this->dummy_column = 'ticket_no';
			}
		}else {
			// it is a board, we working with board;
			$this->model = new Board;
			$this->dummy_column = 'board_id';

		}
	}

	public function getModel(){
		return $this->model;
	}

	public function isExists(){
		return (
			$this->model
			->where( 'scanner_id' , $this->scanner_id  )
			->where( $this->dummy_column, $this->dummy_id )
			->count() > 0 
		);
	}

	protected $big_url = 'http://136.198.117.48/big/public/api/models';

	public function getBoardType($board_id = null, $url=null){
		// what if board id morethan 5 character ??
		// what if board id null ??
		if (is_null( $board_id)) {
			$board_id = $this->dummy_id;
			// get first 5 digit of char
			$board_id = substr($board_id, 0, 5);
		}

		// default value of url is $this->big_url, it is for testing purposes
		if (is_null( $url)) {
			$url = $this->big_url;
		}

		$parameter = '?code=' . $board_id;
		// init curl
		$curl = curl_init();

		if($curl == false){
            throw new HttpException(422);
        }
		// set opt
		curl_setopt_array($curl, [
		    CURLOPT_URL => $url . $parameter,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_TIMEOUT => 30000,
		    CURLOPT_HTTPGET => true,
		    CURLOPT_HEADER => 0,
		    CURLOPT_HTTPHEADER => array(
		    	// Set Here Your Requesred Headers
		        'Content-Type: application/json',
		    ),
		]);

		// send curl
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		// what if error ??
		if ($err) {
			throw new HttpException(422);
		}
		// decode json text into associative array;
		$result = json_decode($response, true);

		// what if not found ??
		if (count($result['data']) > 0) {
			return $result['data'][0]['pwbname'];
		}else{
			throw new HttpException(422);	
		}
	}

	public function prev(){
		
	}
}