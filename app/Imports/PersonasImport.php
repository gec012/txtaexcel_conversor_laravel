<?php

namespace App\Imports;

use App\PersonasSag;
use Maatwebsite\Excel\Concerns\ToModel;

class PersonasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PersonasSag([
            
                'nombre'     => $row[1],
                'cod_tip_documento'   => $row[2], 
                'nro_documento' => $row[3],
                
        ]);
    }
}
