<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\PersonasSag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archivos = Archivo::where('categoria', 'activos')->orderby('created_at','desc')->get();
        return view('sgap_activos.index', compact('archivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { /*use Illuminate\Support\Facades\Storage;

    Storage::delete('file.jpg');

    Storage::delete(['file1.jpg', 'file2.jpg']);

    If necessary, you may specify the disk that the file should be deleted from:

    use Illuminate\Support\Facades\Storage;

    Storage::disk('s3')->delete('folder_path/file_name.jpg');*/
        $personas = PersonasSag::where('archivo_id', $id)->get();
        foreach ($personas as $per) {
            $per->delete();
        }
        $archivo = Archivo::find($id);
        Storage::delete($archivo->url);
        $archivo->delete();
        return redirect()->route('sgap_activos.index')->with('success', 'ARCHIVO ELIMINADO');
    }
}
