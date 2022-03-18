<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        //User::factory(10)->create();
        /////ADMIN/////
        $user = User::create(
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => '12345678'
            ]
        );
        $user = User::create(
            [
                'name' => 'sinacceso',
                'username' => 'sinacceso',
                'password' => '12345678'
            ]
            );
        //$user->syncRoles(['admin']);
        $user = User::create(
            [
                'name' => 'Eduardo',
                'username' => 'zedmous',
                'password' => '8565203'
            ]
            );
       
    }
}
