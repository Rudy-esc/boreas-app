@extends('layout/template')

@section('title', 'Editar Sitios')

@section ('contenido')

<main>
    <div class="container py-4">
    <h2>Registro de nuevo sitio</h2>

    <form action="{{url ('sitios/'.$sitio->id )}}" method="post">
        @method("PUT")
        @csrf

        <div class="mb-3 row">
            <label for="nombredelsitio" class="col-sm-2 col-form-label">Nuevo Lugar: </label>
            <div class="col-sm-5">
            <input type="text" class="form-control" name="nombredelsitio" id="nombredelsitio" value="{{$sitio->NombreSitios}}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="descripciondelsitio" class="col-sm-2 col-form-label">Agrege una descripcion del nuevo Sitio</label>
            <div class="col-sm-5">
            <input type="text" class="form-control" name="descripciondelsitio" id="descripciondelsitio" value="{{$sitio->UbicacionSitios}}" required>
            </div>
        </div>

        <a href="{{url('sitios')}}" class="btn btn-secondary">Regresar</a>

        <button type="submit" class="btn btn-success">Guardar</button>
        
    </form>
    </div>
</main>