<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->email = 'punk73@email.com';
        $user->password = '123456';
        $user->name = 'punk73';
        $user->nik = '39598';
        $user->save();
    }
}
