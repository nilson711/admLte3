<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    protected $fillable = ['id_equip' , 'id_pct', 'id_solicit', 'dias'];
    use HasFactory;
}
