<?php

namespace App\Http\Controllers;

use App\Models\sitio;
use App\Models\objeto;
use App\Models\solicitudes;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $solicitudes = Solicitudes::all();
        return view ('solicitud.index', ['solicitud' => $solicitudes, 'sitios'=>Sitio::all(), 'objetos'=>Objeto::all()]);
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
        $solicitudes=request()->except(['_token','_method']);
        Solicitudes::insert($solicitudes);
        print_r($solicitudes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['solicitudes']=Solicitudes::all();
       return response()->json($data['solicitudes']);
      // return view ();

      $solicitud = Solicitud::findOrFail($id);
      return response()->json($solicitud);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\solicitudes  $solicitudes
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
     * @param  \App\Models\solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $solicitudes=request()->except(['_token','_method']);
        $respuesta=Solicitudes::where('id','=',$id)->update($solicitudes);
        return response()->json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
       $solicitudes=Solicitudes::findOrFail($id);
       Solicitudes::destroy($id);
       return response()->json($id);
    }
}
