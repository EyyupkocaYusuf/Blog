<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Genel','Günlük Hayat','Teknoloji','Bilişim','Gezi','Sağlık','Spor','Eğlence'];
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'slug'=> Str::slug($category),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
