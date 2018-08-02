<?php

use Illuminate\Database\Seeder;
use App\Lineprocess;

class LineprocessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $processes = $this->getProcess();
        $external = ['smt','mecha'];
        foreach ($processes as $key => $process) {
            
            $model = new Lineprocess;
            $model->name = $process;
            $model->type = (in_array($process, $external ))? 2 : 1; //kalau ada di array external, maka 2;
            $model->std_time = 30; //satuannya detik;
            $model->endpoint_id = (in_array($process, $external))? 1 : null ;
            $model->save();
        }
    }

    public function getProcess(){
        return [
            'smt',
            'mecha',
            'MI 1 Main',
            'MI 2 Main',
            'MI Daughter / Display',
            'MI Display',
            'Soldering Machine',
            'Flash Display',
            'TU-Flash Main',
            'ICT Main',
            'JK Separator',
            'AVN Test',
            'Panel 1',
            'Panel 2',
            'Panel 3',
            'Panel 4',
            'Panel 5',
            'Input 1',
            'Input 2',
            'Input 3',
            'Input 4',
            'Input 5',
            'Input 6',
            'Input 7',
            'Input 8',
            'Input 9',
            'Inspect 1',
            'Inspect 2',
            'Inspect 3',
            'Inspect 4',
            'Inspect 5',
            'Inspect 6',
            'Inspect 7',
            'Inspect 8',
            'Chamber',
            'QA 1',
            'QA 2',
            'QA 3',
            'Packing 1',
            'Packing 2',
            'Stock Area'
        ];
    }

}
