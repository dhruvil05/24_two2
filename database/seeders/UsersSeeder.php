<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::count();

        if($users <= 0){

            User::whereIn('id', [1, 2])->delete();
            User::insert(array(
                0=>
                array(
                    'id' => 1, 
                    'first_name' => 'Super',
                    'last_name' => 'Admin',
                    'email' => 'super@admin.com',
                    'password' => bcrypt('superadmin@123'),
                ),

                1=>
                array(
                    'id' => 2, 
                    'first_name' => 'Admin',
                    'last_name' => 'Root',
                    'email' => 'admin@example.com',
                    'password' => bcrypt('admin@123'),
                )
            ));
        }
    }
}
