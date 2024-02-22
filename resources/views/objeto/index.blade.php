@extends('layout/template')

@section('title', 'Objeto')

@section ('contenido')

@include('Home/index')
    <div class="container py-4">
    <h2>Listado de Objetos</h2>


    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Agrega un nuevo sitio
    </button>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo registro de objeto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
      <form action="{{url ('objeto')}}" method="post">
      @csrf

    <div class="form-group">
    <label for="nombredelobjeto" class="col-sm-0 control-label">Nuevo objeto </label>
    <div class="col-sm-14">
    <input type="text" class="form-control" name="nombredelobjeto" id="nombredelobjeto" placeholder="Nombre" required>
    </div>
        </div>

        <div class="form-group">
        <label for="descripciondelobjeto" class="col-sm-0 control-label">Agrege una descripcion del nuevo Objeto</label>
        <div class="col-sm-14">
        <input type="text" class="form-control" name="descripciondelobjeto" id="descripciondelobjeto" placeholder="Descripcion" cols="15" rows="5" required>
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
            <th>Nombre del Objeto</th>
            <th>Descripcion del Objeto</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($objetos as $objeto)
        <tr>
        <td>{{ $objeto->id }}</td>
        <td>{{ $objeto-> NombreObjetos}}</td>
        <td>{{ $objeto-> DescripcionObjetos}}</td>
        <td><a href="{{url ( 'objeto/'.$objeto->id.'/edit' ) }}" class="btn btn-warning btn-sm">Editar</a></td>
        <td>
            <form action="{{url ('objeto/'.$objeto->id)}}" class="d-inline formulario-eliminar-objeto" method="post">
                @method("DELETE")
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>   
    </tr>
        @endforeach
    </tbody>
    </table>

    </div>
@endsection

@section('js')

@if(session('a') == 'c')
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

    $('.formulario-eliminar-objeto').submit(function(e){
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