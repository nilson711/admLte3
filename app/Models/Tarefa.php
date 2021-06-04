<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarefa extends Model
{
    protected $table = "tarefas";
    protected $primaryKey = "id";
    use SoftDeletes;

}
