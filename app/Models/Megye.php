<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Megye extends Model
{
    use HasFactory;
    protected $table = 'megyek';
    protected $megye = 'nev';
    public $primaryKey = 'id';
}
