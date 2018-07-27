<?php

use Illuminate\Database\Seeder;
use App\Connection;

class ConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $connection = new Connection;
        $connection->db_connection = env('DB_CONNECTION', 'sqlsrv');
        $connection->db_host = env('DB_HOST', '127.0.0.1');
        $connection->db_port = env('DB_PORT', '127.0.0.1');
        $connection->db_name = env('DB_DATABASE', '127.0.0.1');
        $connection->db_username = env('DB_USERNAME', '127.0.0.1');
        $connection->db_password = env('DB_PASSWORD', '127.0.0.1');
        $connection->save();
    }
}
