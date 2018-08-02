<?php

use Illuminate\Database\Seeder;
use App\Endpoint;

class EndpointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $endpoint = new Endpoint;
        $endpoint->name = 'AOI';
        $endpoint->url = 'http://somehost/api/AOI';
        $endpoint->save();
    }
}
