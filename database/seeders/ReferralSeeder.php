<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Provider\fi_FI\Person as FakerPerson;
use Faker\Provider\Address as FakerAddress;
use Illuminate\Support\Facades\DB;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $faker->addProvider(new FakerPerson($faker));
        $faker->addProvider(new FakerAddress($faker));
        $profile = DB::table('users_profile')->get();

        foreach ($profile as $value) {
            $type_id = $value->user_id % 2 == 0 ? 6 : 5;
            $hospital_id = $value->user_id % 2 == 0 ? 3 : 4;
            $step = $value->user_id % 2 == 0 ? 2 : 1;
            DB::table('refferal_patient')->insert([
                'user_id' => $value->user_id,
                'type_id' => $type_id,
                'date' => date('Y-m-d'),
                'hospital_id' => $hospital_id,
                'step' => $step,
                'status' => 2,
                'no_reg' => $faker->personalIdentityNumber,
            ]);
        }
    }
}
