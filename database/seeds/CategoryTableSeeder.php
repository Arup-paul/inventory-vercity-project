<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            ['name'=> 'electronics', 'status'=>1,'created_by'=>1,'updated_by'=>1],
            ['name'=> 'furniture', 'status'=>1,'created_by'=>1,'updated_by'=>1],
            ['name'=> 'Accessories', 'status'=>1,'created_by'=>1,'updated_by'=>1],
            ['name'=> 'Gaming', 'status'=>1,'created_by'=>1,'updated_by'=>1],
        ];

        \App\Model\Category::insert($categoryRecords);
    }
}
