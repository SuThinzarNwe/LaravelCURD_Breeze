<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => 'Category'
            ]);
        }
        // DB::table('categories')->insert([
        //     'name' => 'Category'
        // ]);
    }
}
