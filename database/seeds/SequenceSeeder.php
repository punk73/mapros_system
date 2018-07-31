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
        $sequence = new Sequence;
        $sequence->name = 'main';
        $sequence->line_id = 1;
        $sequence->process = '1,2,3,4,5';
        $sequence->save();
    }
}
