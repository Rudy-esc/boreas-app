<?php

namespace App\Http\Controllers;

use App\Models\sitio;
use Illuminate\Http\Request;

class SitioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sitios = Sitio::all();
        return view ('sitios.index', ['sitios' => $sitios]);
        
        
    }

  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('sitios.index'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sitio = new Sitio();
        $sitio->NombreSitios = $request->input('nombredelsitio');
        $sitio->UbicacionSitios = $request->input('descripciondelsitio');
        $sitio->save();
        
        return redirect ('sitios'); 
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sitio  $sitio
     * @return \Illuminate\Http\Response
     */
    public function show(sitio $sitio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sitio  $sitio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sitio = Sitio::find($id);
        return view('sitios.edit', ['sitio'=>$sitio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sitio  $sitio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $sitio = Sitio::find($id);
        $sitio->NombreSitios = $request->input('nombredelsitio');
        $sitio->UbicacionSitios = $request->input('descripciondelsitio');
        $sitio->save();
 
        return redirect ('sitios'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sitio  $sitio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sitio = Sitio::find($id);
        $sitio->delete();
        
        return redirect("sitios")->with('Eliminar', 'ok');
    }
}
