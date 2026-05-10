<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class DatosEmpresa extends Model
{
    protected $table = 'datos_empresa';

    protected $fillable = [
        'nombre_empresa',
        'eslogan_empresa',
        'logo_empresa',
        'descripcion_empresa',
        'derechos_reservados_empresa'
    ];

    // 🔥 ESTO ES LA MAGIA (para usar array como tú quieres)
    protected $casts = [
        'derechos_reservados_empresa' => 'array'
    ];
}