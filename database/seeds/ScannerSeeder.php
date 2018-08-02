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

        $scanner = new Scanner;
        $scanner->line_id = 1;
        $scanner->lineprocess_id = 2;        
        $scanner->name = 'Scanner 02';
        $scanner->mac_address = '65:C7:85:L9';
        $scanner->ip_address = '::1'; //localhost in ipv6
        $scanner->save();
    }

}
