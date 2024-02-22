<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = DB::table('submenus')->count();

        if($menus <= 0){

            DB::table('submenus')->delete();
            DB::table('submenus')->insert(array(
                0=>
                array(
                    'id' => 1, 
                    'submenu_name' => 'Posts List',
                    'link' => 'posts/list',
                    'menu_id' => 2,
                    'route_name' => 'post.list',
                ),

                1=>
                array(
                    'id' => 2, 
                    'submenu_name' => 'Create Post',
                    'link' => 'posts/create',
                    'menu_id' => 2,
                    'route_name' => 'post.create',
                )
            ));
        }
    }
}
