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
                'isadmin' => true,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified' => true,
                'password' => '$2y$10$KL5Zm5nxbQH2ZTrscp31XeVRM3dUQsABRaok21f/N1sM6dBTTjj5a', //QQ@@qq22 real password, this is encrypted by jwt
                'contact_1' => 9988556644,
                'contact_2' => 9238556644,
                'contact_3' => 9988569644,
                'contact_4' => 9168556644,
                'greetings' => 'HAPPY JOURNEY',
                'note_1' => 'Passenger had to pay by himself from our shop to the pick up point of vehicle.',
                'note_2' => 'For Children above 5 years, full ticket is applicable. Passenger is responsible for their own luggage for whole journey.'

            ]
        );
        User::create(
            [
                'isadmin' => false,
                'name' => 'Saiful',
                'email' => 'saiful@admin.com',
                'email_verified' => true,
                'password' => '$2y$10$KL5Zm5nxbQH2ZTrscp31XeVRM3dUQsABRaok21f/N1sM6dBTTjj5a',
                'contact_1' => 8988556644,
                'contact_2' => 8238556644,
                'contact_3' => 8988569644,
                'contact_4' => 8168556644,
                'greetings' => 'HAPPY JOURNEY',
                'note_1' => 'Passenger had to pay by himself from our shop to the pick up point of vehicle.',
                'note_2' => 'For Children above 5 years, full ticket is applicable. Passenger is responsible for their own luggage for whole journey.'

            ]
        );
        User::create(
            [
                'isadmin' => false,
                'name' => 'Aamir',
                'email' => 'aamir@admin.com',
                'email_verified' => false,
                'password' => '$2y$10$KL5Zm5nxbQH2ZTrscp31XeVRM3dUQsABRaok21f/N1sM6dBTTjj5a',
                'contact_1' => 7988556644,
                'contact_2' => 7238556644,
                'contact_3' => 7988569644,
                'contact_4' => 7168556644,
                'greetings' => 'HAPPY JOURNEY',
                'note_1' => 'Passenger had to pay by himself from our shop to the pick up point of vehicle.',
                'note_2' => 'For Children above 5 years, full ticket is applicable. Passenger is responsible for their own luggage for whole journey.'

            ]
        );
     }
}
