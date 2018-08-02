<?php

use Illuminate\Database\Seeder;
use App\Linetype;

class LinetypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$datas= $this->getData();
        foreach ($datas as $key => $data) {
        	$line = new Linetype;
        	$line->name = $data;
        	$line->save();
        }
    }

    public function getData(){
    	return [
    		'Audio',
    		'Display Audio'
    	];
    }
}
