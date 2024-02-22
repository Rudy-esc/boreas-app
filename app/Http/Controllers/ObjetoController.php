<?php

namespace App\Http\Controllers;

use App\Models\objeto;
use Illuminate\Http\Request;

class ObjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetos = Objeto::all(); 
        return view ('objeto.index', ['objetos' => $objetos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('objeto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objeto = new Objeto();
       $objeto->NombreObjetos = $request->input('nombredelobjeto');
       $objeto->DescripcionObjetos = $request->input('descripciondelobjeto');
        $objeto->save();
        
        return redirect ('objeto'); 
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function show(objeto $objeto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $objeto = Objeto::find($id);
        return view('objeto.edit', ['objeto'=>$objeto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $objeto = Objeto::find($id);
        $objeto->NombreObjetos = $request->input('nombredelobjeto');
       $objeto->DescripcionObjetos = $request->input('descripciondelobjeto');
        $objeto->save();

        return redirect ('objeto'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objeto = Objeto::find($id);
        $objeto->delete();
        
        return redirect("objeto")->with('a', 'c'); 
    }
}
