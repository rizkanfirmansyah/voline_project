<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 20; $i++) {

            // insert data ke table pegawai menggunakan Faker
            DB::table('users')->insert([
                'name' => $faker->userName,
                'email' => $faker->email,
                'password' => bcrypt($faker->userName),
                'status' => 1
            ]);
        }
    }
}
