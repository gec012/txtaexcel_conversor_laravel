<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\PersonasUnsa;
use Carbon\Carbon;
use App\Archivo;

class StorageController extends Controller
{
    

    /**
* muestra el formulario para guardar archivos
*
* @return Response
*/
public function index()
{
    return \View::make('/');
}
/**
* guarda un archivo en nuestro directorio local.
*
* @return Response
*/
public function save(Request $request)
{
     //recupera archivo del form
    $file = $request->file('file');

    //recupera el nombre del archivo
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
            $archivo->extension  =   strtolower($file->getClientOriginalExtension());
            $archivo->descripcion = 'Archivo de aportes y de descuentos de la UNSa';
            $archivo->categoria='unsa';
            if($archivo->extension =="txt") {
                    $archivo->save();

                    //nose si usarlo VERRR
                    $contenido = \File::get($file);

                    //variable 
                    $lineas = array();


                    
                    //convierte el archivo en un array donde cada elemento es una linea del txt
                    foreach (file($request->file('file')) as $linea){
                            $lineas[] = $linea;   
                            }    

                    for($k=1;$k < sizeof($lineas);$k++ ){
                            $aux = $lineas[$k];  
                            $i=0;
                            //PARA UNA FILA EM UN STRING BUSCA EL PRIMER CARACTER DEL ALFABETO 
                            while( $i<strlen($aux)){

                                if( $aux[$i]<= 'Z' and  $aux[$i]>= 'A' ){
                                    
                                    break; 
                                                
                                }

                                $i++;
                            };
                            $resultado= \substr($aux , $i ,-1);
                            $j=0;
                            //BUSCA EL ULTIMO CARACTER PARA RECUPERAR EL TIPO DE DOCUMENTO
                            while( $j<strlen($resultado)){
                            if( $resultado[$j]<= '9' and  $resultado[$j]>= '0' ){   
                                    break;         
                            }
                                $j++;
                            }
                            $tipo_documento=trim( \substr($resultado , 0 ,$j-1));

                            $resultado= trim(\substr($resultado , $j ,-1));
                            
                            $i=0;
                            //PARA UNA FILA EM UN STRING BUSCA EL PRIMER CARACTER DEL ALFABETO 
                            while( $i<strlen($resultado)){

                                if( $resultado[$i]<= 'Z' and  $resultado[$i]>= 'A' ){
                                    
                                    break; 
                                                
                                }

                                $i++;
                            };
                            $numero_dni= \substr($resultado ,0, $i+1 );
                            $resultado= \substr($resultado , $i ,-1);

                            $j=0;
                            //BUSCA EL ULTIMO CARACTER PARA RECUPERAR EL TIPO DE DOCUMENTO
                            while( $j<strlen($resultado)){
                            if( $resultado[$j]<= '9' and  $resultado[$j]>= '0' ){  
                                
                                    break;         
                            }
                                $j++;
                            }
                            $nombre=trim(\substr($resultado ,0, $j )); 

                                $resultado= trim(\substr($resultado , $j ,-1));

                            $j=strlen($resultado)-1;
                            //BUSCA EL ULTIMO CARACTER PARA RECUPERAR EL TIPO DE DOCUMENTO
                         
                            $cod = trim(\substr($resultado ,0, 3 ));
                            $resultado= trim(\substr($resultado ,4, -1 ));
                            $monto = trim(\substr($resultado ,0, 9 ));
                            $resultado= trim(\substr($resultado ,9, -1 ));

                            $año_mes = trim(\substr($resultado ,0, 6 ));

                                
                            


                            /*
                                'tipo_documento',
                                'numero_documeno',
                                'nombre_apellido',
                                'codigo',
                                'monto',
                                'año_mes',
                            */
                            $persona = new PersonasUnsa;
                            $persona->tipo_documento = $tipo_documento ;


                            $numero_dni =(int)$numero_dni ;

                            $persona->numero_documento = trim((string)$numero_dni);
                            $aux2= \utf8_decode($nombre); // Busca y remplaza los caracteres desconocidos por un '?'
                            $aux2= \str_replace('?','Ñ',$aux2); // Remplaza el ? por una Ñ
                            $persona->nombre_apellido =$aux2;
                            $persona->codigo = $cod;
                            $monto = (int)$monto/100;
                            
                            $persona->monto =$monto;
                            $auxYear = \substr($año_mes,0,4);
                            $auxMonth = \substr($año_mes,4,5);
                            

                            $persona->año_mes = Carbon::create($auxYear, $auxMonth);
                            $persona->archivo_id = $archivo->id;
                            $persona->save();
                            
                 }    

            
                 return redirect('home')->with('success','ARCHIVO CARGADO EXITOSAMENTE!!!!!!');
            } else{
                return redirect('cargaxls')->with('success','EXTENSION INCORRECTA, CARGUE UN ARCHIVO CORRECTO!!');
            }
        
    }else{
        return redirect('home')->with('success','ARCHIVO YA EXISTENTE!');
    }
}
}
