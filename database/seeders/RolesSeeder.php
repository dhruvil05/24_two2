<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::count();

        if($roles <= 0){

            Role::whereIn('id', [1, 2]);
            Role::insert(array(
                0=>
                array(
                    'id' => 1, 
                    'name' => 'SuperAdmin',
                    
                ),

                1=>
                array(
                    'id' => 2, 
                    'name' => 'Admin',
                )
            ));
        }
    }
}
