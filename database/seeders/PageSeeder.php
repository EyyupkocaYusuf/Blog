<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $pages = ['Hakkımızda','Kariyer','Vizyonumuz','Misyonumuz'];
        $count = 0;
        foreach ($pages as $page)
        {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'image' => 'https://www.hp.com/us-en/shop/app/assets/images/uploads/prod/10-Best-Free-Drawing-Software-Programs16746752375285.jpg',
                'content' => $faker->paragraph(15),
                'slug' => Str::slug($page),
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
