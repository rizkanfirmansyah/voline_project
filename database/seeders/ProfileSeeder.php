<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Provider\fi_FI\Person as FakerPerson;
use Faker\Provider\Address as FakerAddress;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
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
        $profile = DB::table('users')->get();

        foreach ($profile as $value) {
            DB::table('users_profile')->insert([
                'user_id' => $value->id,
                'name' => $faker->name,
                'email' => $value->email,
                'telepon' => $faker->phoneNumber,
                'identity' => $faker->personalIdentityNumber,
                'address' => $faker->address,
                'area_code' => 1811050044
            ]);
        }
    }
}
