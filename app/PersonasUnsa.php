<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonasUnsa extends Model
{
    protected $table='persona_unsa';

    protected $fillable = [
    
        'tipo_documento',
        'numero_documento',
        'nombre_apellido',
        'codigo',
        'monto',
        'año_mes',
    ];
    public function archivos(){
        return $this->belongsTo('App\Archivo','archivo_id');
    }
  
}
