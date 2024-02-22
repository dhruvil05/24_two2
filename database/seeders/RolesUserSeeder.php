<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $role_user = DB::table('role_user')->count();

        if($role_user <= 0){

            DB::table('role_user')->delete();
            DB::table('role_user')->insert(array(
                0=>
                array(
                    'user_id' => 1,
                    'role_id' => 1,
                ),

                1=>
                array(
                    'user_id' => 2,
                    'role_id' => 2,
                )
            ));
        }
    }
}
