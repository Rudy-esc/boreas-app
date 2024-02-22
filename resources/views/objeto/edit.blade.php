@extends('layout/template')

@section('tltle', 'Editar Cargos')

@section ('contenido')

<main>
    <div class="container py-4">
    <h2>Editar Cargo</h2>

    <form action="{{ url ('objeto/'.$objeto->id ) }}" method="post">
    @method("PUT")    
    @csrf

    <div class="mb-3 row">
            <label for="nombredelobjeto" class="col-sm-2 col-form-label">Nuevo Objeto</label>
            <div class="col-sm-5">
            <input type="text" class="form-control" name="nombredelobjeto" id="nombredelobjeto" value="{{$objeto->NombreObjetos}}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="descripciondelobjeto" class="col-sm-2 col-form-label">Agrege una descripcion del nuevo Objeto</label>
            <div class="col-sm-5">
            <input type="text" class="form-control" name="descripciondelobjeto" id="descripciondelobjeto" value="{{$objeto->DescripcionObjetos}}" required>
            </div>
        </div>

        <a href="{{url('objeto')}}" class="btn btn-secondary">Regresar</a>

        <button type="submit" class="btn btn-success">Guardar</button>
        
        
    </form>
    </div>
</main>