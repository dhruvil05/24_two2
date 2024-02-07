<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'submenu_name',
        'link',
        'menu_id',
        'route_name',
    ];

    protected $table = 'submenu';

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

}
