<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Imports\PersonasImport;
use App\Imports\PadronSagImport;
use Carbon\Carbon;
use App\PersonasSag;
use App\PadronSag;
use App\Archivo;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class StorageExcelController extends Controller
{

    /* Funcion para guardar el excel del padron de activos del SAG */
    public function save(Request $request)
        {
            //recupera archivo del form
            $file = $request->file('filexls');

            $nombre = $file->getClientOriginalName(); 
            $carpeta =(string) Carbon::today();
            $carpeta = \substr($carpeta,0,7);
            
            //indicamos que queremos guardar un nuevo archivo en el disco local
            $path = Storage::putFileAs($carpeta,  $file, $nombre);

            $archivos = Archivo::all(); 
            $band = true;
            foreach ($archivos as $archivo){
                if ($archivo->url == 'app/'.$path){
                    $band = false;
                    break;
                }
                
            }

            if($band){

                    $archivo = new Archivo();
                    $archivo->url = 'app/'.$path;
                    $archivo->nombre = $nombre;
                    $archivo->extension  =  strtolower( $file->getClientOriginalExtension());
                    $archivo->descripcion = 'Archivo de afiliados activos en el SGAP ';
                    $archivo->categoria='activos';
                    
        

                    //recupera el nombre del archivo
                    
                    if($archivo->extension=="xlsx"){
                    Excel::import(new PersonasImport,$request->file('filexls'));
                   
                    $personas = PersonasSag::all();
                    foreach( $personas as $per){
                        if(trim($per->nombre) == 'nombre'){
                            
                            $per->delete();
                        }
                    }
                    
                    
                    $archivo->save();

                    $personas = PersonasSag::where('archivo_id',null)->get();
                    foreach( $personas as $persona){
                        $persona->archivo_id = $archivo->id;
                        $persona->save();
                    }
                    return  redirect('home')->with('success','ARCHIVO CARGADO EXITOSAMENTE!!!!!!');

                }else{
            return  redirect('cargaxls')->with('success','LA EXTENSION DEL ARCHIVO NO ES SOPORTADA ,CARGUE UN ARCHIVO CORRECTO!!!!!!!!');
                     
                }
                  
                    }else {

                    return  redirect('home')->with('success','ARCHIVO YA EXISTE');
                }
                    
        }    

   
}
