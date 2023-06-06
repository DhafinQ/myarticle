<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technologies',
            ],
            [
                'name' => 'AI',
            ],
            [
                'name' => 'Programming',
            ],
            [
                'name' => 'Design',
            ],
        ];

        foreach($categories as $category){
            Category::create($category);
        }
    }
}
