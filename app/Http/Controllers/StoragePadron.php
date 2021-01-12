<?php

namespace App\Http\Controllers;


use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Imports\PadronSagImport;
use Carbon\Carbon;
use App\PadronSag;
use App\Archivo;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StoragePadron extends Controller
{
    public function savepadron(Request $request)
        {
           
            //recupera archivo del form
            $file = $request->file('filepadron');
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
                    $archivo->extension  =  strtolower($file->getClientOriginalExtension());
                    $archivo->descripcion = 'Archivo de afiliados titulares de alta y baja en el SGAP';
                    $archivo->categoria='sgap';
                   
        
            
                    
                    //recupera el nombre del archivo
                         if($archivo->extension=="xlsx"){
                            Excel::import(new PadronSagImport,$request->file('filepadron'));
                            //indicamos que queremos guardar un nuevo archivo en el disco local.
                        // $path = Storage::putFileAs('archivoxlsx',  $file, $nombre);
                        $personas = PadronSag::all();
                         foreach( $personas as $per){
                                if(trim($per->nombre) == 'nombre'){
                                    $per->delete();
                                }
                        }      
                        $archivo->save();
                        $personas = PadronSag::where('archivo_id',null)->get();
                        foreach( $personas as $persona){
                            $persona->archivo_id = $archivo->id;
                            $persona->save();
                        }
                        return  redirect('home')->with('success','ARCHIVO CARGADO EXITOSAMENTE!!!!!!');

                    }else{
            return  redirect('padron_sag')->with('success','LA EXTENSION DEL ARCHIVO NO ES SOPORTADA ,CARGUE UN ARCHIVO CORRECTO!!!!!!!!');
                    }
        
            }else{return  redirect('home')->with('success','EL ARCHIVO YA EXISTE!');}           
        }
}
