<?php

/**
 * 
 */
namespace App\V1\Helper;
use App\Model;
use App\Board;

class Node
{
	protected $model;
	protected $ticketCriteria = [
		'MST', 'PNL', 'MCH'
	];

	function __construct($board_id)
	{	
		$code = substr($board_id, 0, 3);
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
	},




}