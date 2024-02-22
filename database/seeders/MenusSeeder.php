<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = DB::table('menus')->count();

        if($menus <= 0){

            DB::table('menus')->delete();
            DB::table('menus')->insert(array(
                0=>
                array(
                    'id' => 1, 
                    'menu_name' => 'Dashboard',
                    'url' => 'dashboard',
                    'route_name' => 'dashboard',
                ),

                1=>
                array(
                    'id' => 2, 
                    'menu_name' => 'Posts',
                    'url' => 'posts/list',
                    'route_name' => 'postList',
                )
            ));
        }

    }
}
