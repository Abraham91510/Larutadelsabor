<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $fillable = ['codigo','descuento','tipo','expira_en','uso_maximo','usos'];
}