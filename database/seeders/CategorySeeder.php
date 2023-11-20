<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'category' => 'Toko Sembako'
        ]);

        DB::table('categories')->insert([
            'category' => 'Bisnis Pencucian'
        ]);

        DB::table('categories')->insert([
            'category' => 'Bisnis Makanan'
        ]);

        DB::table('categories')->insert([
            'category' => 'Bisnis Minuman'
        ]);

        DB::table('categories')->insert([
            'category' => 'Bengkel'
        ]);

        DB::table('categories')->insert([
            'category' => 'Tanaman Hidroponik'
        ]);

        DB::table('categories')->insert([
            'category' => 'Peternakan'
        ]);

        DB::table('categories')->insert([
            'category' => 'Pertanian'
        ]);

        DB::table('categories')->insert([
            'category' => 'Warung'
        ]);
    }
}
