@extends('layout/template')

@section('title', 'Sitios')


@section ('contenido')
@include('Home/index')
    
    <div class="col "></div>

    
    <h2>Listado de Sitios Disponibles</h2>

    
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Agrega un nuevo sitio
    </button>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Sitio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <form method="post" action="{{url ('sitios')}}">
      @csrf

    <div class="form-group">
    <label for="nombredelsitio" class="col-sm-0 control-label">Nuevo Lugar </label>
    <div class="col-sm-14">
    <input type="text" class="form-control" name="nombredelsitio" id="nombredelsitio" placeholder="Nombre" required>
    </div>
        </div>

        <div class="form-group">
        <label for="descripciondelsitio" class="col-sm-0 control-label">Agrege una descripcion del nuevo Sitio</label>
        <div class="col-sm-14">
        <input type="text" class="form-control" name="descripciondelsitio" id="descripciondelsitio" placeholder="Descripcion" cols="15" rows="5" required>
         </div>
        </div>
      </div>

      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>   
    </div>
  </div>
</div>

    <table class="table table-hover">

    <thead>
        <tr>
            <th>#</th>
            <th>Nombre del Sitio</th>
            <th>Descripcion del Sitio</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($sitios as $sitio)
        <tr>
        <td>{{ $sitio->id }}</td>
        <td>{{ $sitio-> NombreSitios}}</td>
        <td>{{ $sitio-> UbicacionSitios}}</td>
        <td><a href="{{url ( 'sitios/'.$sitio->id.'/edit' ) }}" class="btn btn-warning btn-sm">Editar</a></td>
        <td>
            <form action="{{url ('sitios/'.$sitio->id)}}" class="d-inline formulario-eliminar" method="POST">
                @method("DELETE")
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>   
    </tr>
        @endforeach
    </tbody>
    </table>

  
@endsection

@section('js')

@if(session('Eliminar') == 'ok')
<script>
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  title: "Eliminacion Completa!"
});
</script>
@endif

<script>

    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
    title: "Estas Seguro?",
    text: "Estos datos no se podran recuperar!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Deseo eliminar"
    }).then((result) => {
    if (result.isConfirmed) {
       
        this.submit();
    }
    });
        });

    
</script>

@endsection