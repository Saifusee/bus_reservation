<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'isadmin' => 1,
                'first_name' => 'Saiful',
                'last_name' => 'Khan',
                'username' => 'Saifusee',
                'email' => 'mohammad@gmail.com',
                'password' => 'helloji',
            ]
        );
        User::create(
            [
                'isadmin' => 0,
                'first_name' => 'Aamir',
                'last_name' => 'Khan',
                'username' => 'aamir1919',
                'email' => 'aamir@gmail.com',
                'password' => 'hellojiohhohh',
            ]
        );
     }
}
