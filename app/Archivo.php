<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{

    protected $table = 'archivos';

    protected $fillable = [

        'url', 'descripcion', 'extension', 'categoria',
        'nombre',
    ];
    public function padronsag()
    {
        return $this->hasMany('App\PadronSag', 'archivo_id');
    }
    public function personassag()
    {
        return $this->hasMany('App\PersonasSag', 'archivo_id');
    }
    public function personaunsa()
    {
        return $this->hasMany('App\PersonasUnsa', 'archivo_id');
    }
}
