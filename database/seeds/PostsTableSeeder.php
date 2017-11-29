<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');
        for ($i=0; $i < 100; $i++) {
            $title = $faker->sentence();
            $slug = str_slug($title);
            DB::table('posts')->insert([
                'user_id'       => rand(1, 9),
                'category_id'   => rand(1, 3),
                'photo_id'      => rand(1, 9),
                'title'         => $title,
                'slug'          => $slug,
                'body'          => $faker->text(500),
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
