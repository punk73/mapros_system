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

    /*public function seedScanner(){

        $scanners = [
            // id  name    mac_address ip_address  lineprocess_id  line_id input_by    input_at    update_by   update_at
            [   'name'=>'SCN201807140001', 'mac_address'=>'12:34:56:78:90:12', 'ip_address'=>  '10.230.38.1', 'line_process_id' =>  3  , 'line_id' 1],
            [   'name'=>'SCN201807140002', 'mac_address'=>'12:34:56:78:90:33', 'ip_address'=>  '10.230.38.2', 'line_process_id' =>  4  , 'line_id' 1],
            [   'name'=>'SCN201807140003', 'mac_address'=>'12:34:56:78:90:34', 'ip_address'=>  '10.230.38.3', 'line_process_id' =>  5  , 'line_id' 1],
            [   'name'=>'SCN201807140004', 'mac_address'=>'12:34:56:78:90:35', 'ip_address'=>  '10.230.38.4', 'line_process_id' =>  6  , 'line_id' 1],
            [   'name'=>'SCN201807140005', 'mac_address'=>'12:34:56:78:90:36', 'ip_address'=>  '10.230.38.5', 'line_process_id' =>  8  , 'line_id' 1],
            [   'name'=>'SCN201807140006', 'mac_address'=>'12:34:56:78:90:37', 'ip'=>  '10.230.38.6',    9  , 1],
            [   'name'=>'SCN201807140007', 'mac_address'=>'12:34:56:78:90:38', 'ip'=>  '10.230.38.7',    10 , 1],
            [   'name'=>'SCN201807140008', 'mac_address'=>'12:34:56:78:90:39', 'ip'=>  '10.230.38.8',    12 , 1],
            [   'name'=>'SCN201807140009', 'mac_address'=>'12:34:56:78:90:40', 'ip'=>  '10.230.38.9',    13 , 1],
            [   'name'=>'SCN201807140017', 'mac_address'=>'12:34:56:78:90:19', 'ip'=>  '10.230.38.17',   21,  1],
            [   'name'=>'SCN201807140018', 'mac_address'=>'12:34:56:78:90:20', 'ip'=>  '10.230.38.18',   22,  1],
            [   'name'=>'SCN201807140019', 'mac_address'=>'12:34:56:78:90:21', 'ip'=>  '10.230.38.19',   23,  1],
            [   'name'=>'SCN201807140020', 'mac_address'=>'12:34:56:78:90:22', 'ip'=>'10.230.38.20',   24,  1],
            [   'name'=>'SCN201807140021', 'mac_address'=>'12:34:56:78:90:23', 'ip'=>'10.230.38.21',   25,  1],
            [   'name'=>'SCN201807140022', 'mac_address'=>'12:34:56:78:90:24', 'ip'=>'10.230.38.22',   26,  1],
            [   'name'=>'SCN201807140023', 'mac_address'=>'12:34:56:78:90:25', 'ip'=>'10.230.38.23',   27,  1],
            [   'name'=>'SCN201807140024', 'mac_address'=>'12:34:56:78:90:26', 'ip'=>'10.230.38.24',   28,  1],
            [   'name'=>'SCN201807140025', 'mac_address'=>'12:34:56:78:90:27', 'ip'=>'10.230.38.25',   29,  1],
            [   'name'=>'SCN201807140026', 'mac_address'=>'12:34:56:78:90:28', 'ip'=>'10.230.38.26',   30,  1],
            [   'name'=>'SCN201807140027', 'mac_address'=>'12:34:56:78:90:29', 'ip'=>'10.230.38.27',   31,  1],
            [   'name'=>'SCN201807140028', 'mac_address'=>'12:34:56:78:90:30', 'ip'=>'10.230.38.28',   32,  1],
            [   'name'=>'SCN201807140029', 'mac_address'=>'12:34:56:78:90:31', 'ip'=>'10.230.38.29',   33,  1],
            [   'name'=>'SCN201807140030', 'mac_address'=>'12:34:56:78:90:32', 'ip'=>'10.230.38.30',   34,  1],
        ]

        foreach ($scanners as $key => $scanner) {
            $scanner = new Scanner;
            $scanner->sequence_id = 2;
            $scanner->name = 'Scanner 02';
            $scanner->mac_address = '65:C7:85:L9';
            $scanner->ip_address = '::1'; //localhost in ipv6
            $scanner->save();
        }
    }*/
}
