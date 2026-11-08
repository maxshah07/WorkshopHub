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
    public function run(): void
    {
        $names = [
            'Programming',
            'Cooking',
            'Photography',
            'Arts and Crafts',
        ];

        foreach ($names as $name) {
            Category::firstOrCreate([
                'name' => $name,
            ]);
        }
    }
}
