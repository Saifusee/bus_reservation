<?php

use Illuminate\Database\Seeder;
use App\Ticket;
use Carbon\Carbon;
class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::create([
            'from_location' => 'AJMER',
            'to_location' => 'AGRA',
            'booking_date' => Carbon::createFromDate('2021-09-12')->toDateTimeString(),
            'departure_date' => Carbon::createFromDate('2021-09-13')->toDateTimeString(),
            'passenger_name' => 'KHANNA',
            'passenger_contact_1' => '9829676728',
            'passenger_contact_2' => '9829676728',
            'email' => '9829676728@gmail.com',
            'reporting_time' => '20:00:00',
            'departure_time' => '20:30:00',
            'sleeper_no' => 'S1-S2',
            'seat_no' => '',
            'bus_no' => 5643,
            'total_seats' => 4,
            'amount' => 800,
            'advance' => 800,
            'balance' => 0,
            'user_id' => 1,
            'pickup_point_id' => 4,
            'partner_travel_id' => 3,
        ]);
        Ticket::create([
            'from_location' => 'AJMER',
            'to_location' => 'AHMEDABAD',
            'booking_date' => Carbon::createFromDate('2021-09-13')->toDateTimeString(),
            'departure_date' => Carbon::createFromDate('2021-09-14')->toDateTimeString(),
            'passenger_name' => 'MUGHAL KHANNA',
            'passenger_contact_1' => '9829676728',
            'passenger_contact_2' => '9829676728',
            'email' => '9829676728@gmail.com',
            'reporting_time' => '19:00:00',
            'departure_time' => '19:30:00',
            'sleeper_no' => 'S1-S3',
            'seat_no' => 'D1',
            'bus_no' => 5623,
            'total_seats' => 3,
            'amount' => 800,
            'advance' => 600,
            'balance' => 200,
            'user_id' => 2,
            'pickup_point_id' => 3,
            'partner_travel_id' => 4,
        ]);
        Ticket::create([
            'from_location' => 'AJMER',
            'to_location' => 'MUMBAI',
            'booking_date' => Carbon::createFromDate('2021-09-16')->toDateTimeString(),
            'departure_date' => Carbon::createFromDate('2021-09-17')->toDateTimeString(),
            'passenger_name' => 'ABU MAN',
            'passenger_contact_1' => '9829676728',
            'passenger_contact_2' => '9829676728',
            'email' => '9829676728@gmail.com',
            'reporting_time' => '16:00:00',
            'departure_time' => '16:30:00',
            'sleeper_no' => '',
            'seat_no' => '9',
            'bus_no' => 9923,
            'total_seats' => 1,
            'amount' => 1200,
            'advance' => 1200,
            'balance' => 0,
            'user_id' => 1,
            'pickup_point_id' => 1,
            'partner_travel_id' => 1,
        ]);
        Ticket::create([
            'from_location' => 'AJMER',
            'to_location' => 'KANNAUT',
            'booking_date' => Carbon::createFromDate('2021-09-13')->toDateTimeString(),
            'departure_date' => Carbon::createFromDate('2021-09-14')->toDateTimeString(),
            'passenger_name' => 'REHMAN',
            'passenger_contact_1' => '9829676728',
            'passenger_contact_2' => '9829676728',
            'email' => '9829676728@gmail.com',
            'reporting_time' => '20:00:00',
            'departure_time' => '20:30:00',
            'sleeper_no' => 'S1-S2',
            'seat_no' => '',
            'bus_no' => 5643,
            'total_seats' => 4,
            'amount' => 800,
            'advance' => 500,
            'balance' => 300,
            'user_id' => 1,
            'pickup_point_id' => 4,
            'partner_travel_id' => 1,
        ]);
        Ticket::create([
            'from_location' => 'AJMER',
            'to_location' => 'DELHI',
            'booking_date' => Carbon::createFromDate('2021-09-13')->toDateTimeString(),
            'departure_date' => Carbon::createFromDate('2021-09-14')->toDateTimeString(),
            'passenger_name' => 'GUAR',
            'passenger_contact_1' => '9829676728',
            'passenger_contact_2' => '9829676728',
            'email' => '9829676728@gmail.com',
            'reporting_time' => '18:00:00',
            'departure_time' => '28:30:00',
            'sleeper_no' => '9-10-11',
            'seat_no' => '',
            'bus_no' => 2432,
            'total_seats' => 6,
            'amount' => 2400,
            'advance' => 1500,
            'balance' => 900,
            'user_id' => 1,
            'pickup_point_id' => 4,
            'partner_travel_id' => 3,
        ]);
    }
}