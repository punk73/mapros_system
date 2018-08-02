<?php

use Illuminate\Database\Seeder;
use App\Sequence;

class SequenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $sequences = $this->getData();
        foreach ($sequences as $key => $data) {
            # code...
            $sequence = new Sequence;
            $sequence->name = $data[0];
            $sequence->line_id = $data[1];
            $sequence->process = $data[2];
            $sequence->save();
        }

    }

    public function getData(){
        // name    line_id process
        return [
            ['PNL',     1,   '13,14,15,16,17,20'],
            ['MST',     1,   '18,19,20,27,35,28,29,30,31,32,33,36,37,38,39,40'],
            ['MAIN',    1,   '1,3,4,7,9,10,12,18'],
            ['Daughter',1,   '1,5,7,18'],
            ['Switch',  1,   '1,5,7,8,13'],
        ];
    }
}
