<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Varos extends Model
{
    use SoftDeletes;
    protected $table = 'city';
    protected $fillable = ['name', 'county_id'];

    public function counties(){
        return $this->hasMany('App\Models\Megye');
    }
}