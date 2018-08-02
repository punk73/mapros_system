<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ScannerSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SequenceSeeder::class);
        $this->call(LineprocessSeeder::class);
        $this->call(EndpointSeeder::class);
        $this->call(LineSeeder::class);
        $this->call(LinetypeSeeder::class);
    }
}
