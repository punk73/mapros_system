<?php

use Illuminate\Database\Seeder;
use App\Scanner;

class ScannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Scanner::class, 10 )->create();
    }
}
