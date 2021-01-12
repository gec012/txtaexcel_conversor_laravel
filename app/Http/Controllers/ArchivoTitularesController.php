<?php

namespace App\Http\Controllers;

use App\Archivo;
use Illuminate\Http\Request;
use App\PadronSag;
use Illuminate\Support\Facades\Storage;

class ArchivoTitularesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archivos  = Archivo::where('categoria','sgap')->orderby('created_at','desc')->get();
        return view('sgap_todos.index',compact('archivos'));
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
    {
        
        $personas = PadronSag::where('archivo_id', $id)->get();
        foreach ($personas as $per) {
            $per->delete();
        }
        $archivo = Archivo::find($id);
        Storage::delete($archivo->url);
        $archivo->delete();
        return redirect()->route('sgap_todos.index')->with('success', 'ARCHIVO ELIMINADO');
    }
}
