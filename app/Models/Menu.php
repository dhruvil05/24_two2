<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_name',
        'url',
        'route_name'

    ];
    protected $table = 'menu';

    public function submenu(){
        return $this->hasMany(SubMenu::class);
    }
}
