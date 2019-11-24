<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'tbl_estado';

    public function ciudades()
    {
        return $this->hasMany('App\Ciudad');
    }
}
