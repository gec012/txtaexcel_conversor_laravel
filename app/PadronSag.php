<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PadronSag extends Model
{
    protected $table = 'padron_sag';

    protected $fillable = [

        'cod_tip_documento',
        'nro_documento',
        'nombre',
    ];
    public function archivos()
    {
        return $this->belongsTo('App\Archivo', 'archivo_id');
    }
}
