<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'name' => 'Dress'
        ]);
        DB::table('category')->insert([
            'name' => 'Shirts'
        ]);
        DB::table('category')->insert([
            'name' => 'Kurta'
        ]);
        DB::table('category')->insert([
            'name' => 'Jeans'
        ]);
        DB::table('category')->insert([
            'name' => 'T-shirt'
        ]); 
        
    }
}
