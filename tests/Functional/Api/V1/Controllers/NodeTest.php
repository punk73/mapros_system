<?php

namespace App\Functional\Api\V1\Controllers;

use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Api\V1\Helper\Node;
use App\Board;
use App\Scanner;
use Illuminate\Support\Facades\Artisan;

class NodeTest extends TestCase
{
    use DatabaseMigrations;

    protected $parameter = [
        'board_id'=> '00055IA01001007',
        'nik' => '39596',
        'ip' => '::1', //localhost scanner
        'is_solder' => false,
    ];

    /*
    * @instantiate Node class
    * 
    *
    *
    */

    public function testInstanstiateNodeClassSuccess(){
        $node = new Node($this->parameter);
        $this->assertInstanceOf('App\Board', $node->getModel() );
    }

    private function addModel(){
        $board = new Board;
        $board->scanner_id = 11; //scanner_id untuk ip ::1
        $board->board_id = $this->parameter['board_id'];
        $board->scan_nik = $this->parameter['nik'];
        $board->status = 'in';
        $board->save();
    }

    public function seedDb(){
        // it's mean to seed the db for testing purpose;
        // Artisan::call('migrate:refresh');
        Artisan::call('db:seed', ['--class'=>'ScannerSeeder'] );
    }

    public function testIsExistsReturnFalse(){
        $board = Board::all();
        $this->assertEquals(count($board), 0, 'this model should empty for testing it' );

        $node = new Node($this->parameter);
        $this->assertEquals( false, $node->isExists() );
    }

    public function testIsExistsReturnTrue(){
        $this->addModel();
        // seed the scanner database
        $this->seedDb();

        $board = Board::all();
        $scanners = Scanner::where('ip_address', '::1')->get();

        // assertGreaterThan( $idealValue , $assertedValue )
        $this->assertGreaterThan( 0, count($scanners));
        $this->assertGreaterThan( 0, count($board));

        $node = new Node($this->parameter);

        $this->assertEquals(11, $node->scanner_id );
        // assertEquals($expected, $actual )
        $this->assertEquals( true, $node->isExists() );
    }

    public function testPrevMethod(){
        
    }

}
