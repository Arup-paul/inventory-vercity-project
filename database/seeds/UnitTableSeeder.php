<?php

use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unitRecords = [
            ['name'=> 'kg', 'status'=>1,'created_by'=>1,'updated_by'=>1],
            ['name'=> 'gm', 'status'=>1,'created_by'=>1,'updated_by'=>1],
            ['name'=> 'litter', 'status'=>1,'created_by'=>1,'updated_by'=>1],


        ];
        \App\Model\Unit::insert($unitRecords);
    }
}
