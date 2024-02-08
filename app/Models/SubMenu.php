<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'submenu_name',
        'link',
        'menu_id',
        'route_name',
    ];

    protected $table = 'submenus';

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

}
