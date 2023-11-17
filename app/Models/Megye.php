<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Megye extends Model
{
    protected $table = 'county';
    protected $nev = 'name';

    public function cities(){
        return $this->hasMany(Varos::class, 'county_id', 'id');
    }
}
