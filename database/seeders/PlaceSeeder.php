<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Place::create([
                'name' => 'Category'
            ]);
        }
        // DB::table('categories')->insert([
        //     'name' => 'Category'
        // ]);
    }
}
