<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Varos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'varosok';
    protected $fillable = ['nev', 'megyeId'];
}
