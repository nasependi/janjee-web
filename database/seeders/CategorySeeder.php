<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = [
            ['name' => 'Futsal', 'image' => 'logojanjee/Soccer-rafiki.svg'],
            ['name' => 'Mini Soccer', 'image' => 'logojanjee/Soccer-bro.svg'],
            ['name' => 'Barbershop', 'image' => 'logojanjee/barber.jpg'],
        ];

        foreach ($categoryData as $key => $value) {
            Category::updateOrCreate([
                'name' => $value['name'],
                'slug' => Str::slug($value['name']),
            ], [
                'image' => $value['image']
            ]);
        }
    }
}
