<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Megye extends Model
{
    protected $table = 'county';
    protected $nev = 'name';

    public function Megye(){
        return $this->belongsTo('App\Models\Varos');
    }
}
