<?php

/**
 * 
 */
namespace App\V1\Helper;
use App\Model;
use App\Board;
use App\Ticket;


class Node
{
	protected $model;
	protected $ticketCriteria = [
		'PNL', 'MST', 'MCH'
	];

	function __construct($board_id)
	{	
		$code = substr($board_id, 0, 3);
		if (in_array($code, $this->ticketCriteria )) {
			// it is ticket, so we work with ticket
			if($code == 'PNL'){
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