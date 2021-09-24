<?php

use Illuminate\Database\Seeder;
use App\PickupPoint;

class PickupPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PickupPoint::create([
            'pickup_point_address' => 'sanjar nagar, khanpura, ajmer (305001)',
            'user_id' => 1,
        ]);
        PickupPoint::create([
            'pickup_point_address' => 'kavandaspura, langar gali, khanpura, ajmer (305001)',
            'user_id' => 2,
        ]);
        PickupPoint::create([
            'pickup_point_address' => 'hatibata, partap mohalla, khanpura, ajmer (305001)',
            'user_id' => 1,
        ]);
        PickupPoint::create([
            'pickup_point_address' => 'uday bhawan, railway station, khanpura, ajmer (305001)',
            'user_id' => 1,
        ]);
        PickupPoint::create([
            'pickup_point_address' => 'ajmer tower, kutchery road, khanpura, ajmer (305001)',
            'user_id' => 2,
        ]);
        PickupPoint::create([
            'pickup_point_address' => 'phool gali, moti katla, ajmer (305001)',
            'user_id' => 1,
        ]);
    }
}
