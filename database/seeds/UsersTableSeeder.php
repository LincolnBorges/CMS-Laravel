<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');
        for ($i=0; $i < 10; $i++) {
                DB::table('users')->insert([
                    'role_id'   => 1,
                    'is_active' => 1,
                    'name'      => $faker->name,
                    'email'     => $faker->email,
                    'password'  => bcrypt(str_random(10)),
                    'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
                ]);
        }
    }
}
