<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'arup paul',
            'email' => 'aruppaul@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'mobile'=> '01866702189',

        ]);
    }
}
