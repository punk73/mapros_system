<?php

use Illuminate\Database\Seeder;
use App\Line;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = $this->getData();
        foreach ($datas as $key => $value) {
        	$line = new Line;
        	$line->name = $value[0];
        	$line->linetype_id = $value[1];
        	$line->save();
        }
    }

    public function getData(){
    	return [
    		// name	linetype_id
			['Line 01',	1],
			['Line 02',	1],
			['Line 03',	2],
			['Line 04',	2],
    	];
    }
}
