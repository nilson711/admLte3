<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recarga extends Model
{
    protected $fillable = ['id_equip' , 'id_pct', 'id_fornec', 'id_hc', 'preco_recarga' ];
    use HasFactory;
}
