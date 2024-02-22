@extends('layout.app')
@section('scripts')

<link rel="stylesheet" href="{{ asset('fullcalendar/core/main.css') }}">
<link rel="stylesheet" href="{{ asset('fullcalendar/daygrid/main.css') }}">
<link rel="stylesheet" href="{{ asset('fullcalendar/list/main.css') }}">
<link rel="stylesheet" href="{{ asset('fullcalendar/timegrid/main.css') }}">


<script src="{{ asset('fullcalendar/core/main.js') }}" defer></script>
<script src="{{ asset('fullcalendar/interaction/main.js') }}" defer></script>
<script src="{{ asset('fullcalendar/daygrid/main.js') }}" defer></script>
<script src="{{ asset('fullcalendar/list/main.js') }}" defer></script>
<script src="{{ asset('fullcalendar/timegrid/main.js') }}" defer></script>



<script>


document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {

    
    plugins: [ 'dayGrid', 'interaction', 'timeGrid', 'list' ],
   

  header:{
    left:'prev, next, today',
    center: 'title',
    right:'dayGridMonth, timeGridWeek, timeGridDay'

  },
  

  dateClick:function(info){
    $('#btnEliminar').hide();
    $('#btnModificar').hide();
    $('#btnAgregar').show();

    $('#txtID').val("");
    $('#txtTitulo').val("");
    $('#txtFechaStart').val(info.dateStr);
    $('#txtHoraStart').val("");
    $('#txtFechaEnd').val(info.dateStr);
    $('#txtHoraEnd').val("");
    $('#txtDescripcion').val("");
    $('#txtSitio').val("");
    $('#txtObjeto').val("");
       
    // Alerta de dias inabiles//
    var a = info.dateStr;
    const fechaComoCadena = a;
    var numeroDia = new Date (fechaComoCadena).getDay();

    if((numeroDia == "0") || (numeroDia == "1") || (numeroDia == "2") || (numeroDia == "3") || (numeroDia == "4") || (numeroDia == "5")){
      $('#exampleModal').modal('show');
    }else{
      Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Este dia es inhábil!",
  
});
    }
   
  },

  
  eventClick:function(info) {
              $('#btnAgregar').hide();
              $('#btnModificar').show();
              $('#btnEliminar').show();

              $('#txtID').val(info.event.id);
              $('#txtTitulo').val(info.event.title);
              $('#txtSitio').val(info.event.SitiosId);

              mes = (info.event.start.getMonth()+1);
              dia = (info.event.start.getDate());
              anio = (info.event.start.getFullYear());

              hora = (info.event.start.getHours()+":"+info.event.getMinutes());

              $('#txtFechaStart').val(info.event.start);
              $('#txtHoraStart').val(info.event.start);
              $('#textFechaEnd').val(info.event.end);
              $('#txtHoraEnd').val(info.event.end);
              $('#DescripcionSolicitud').val(info.event.txtDescripcion);
              $('#txtObjeto').val(info.event.ObjetosId);

            $('#exampleModal').modal('show');
           
  },
  eventResize: function(info) {

              $('#txtID').val(info.event.id);
              $('#txtTitulo').val(info.event.title);
              $('#txtSitio').val(info.event.SitiosId);
              $('#txtFechaStart').val(info.event.start);
              $('#txtFechaStart').val(info.event.start);
              $('#textFechaEnd').val(info.event.end);
              $('#DescripcionSolicitud').val(info.event.txtDescripcion);
              $('#txtObjeto').val(info.event.ObjetosId);
              ObjSolicitud=recolectarDatosGUI();
              recolectarDatosGUI(objSolicitud);
  },
  
  events:"{{url ('solicitud/show')}}"
 

  });
  calendar.setOption('locale', 'ES');

  calendar.render();

  //Botones//

  $('#btnAgregar').click(function(){
    ObjSolicitud=recolectarDatosGUI("POST");

    EnviarInformacion('',ObjSolicitud);

  });

  $('#btnEliminar').click(function(){
    ObjSolicitud=recolectarDatosGUI("DELETE");

    EnviarInformacion('/'+$('#txtID').val(),ObjSolicitud);

  });

  $('#btnModificar').click(function(){
    ObjSolicitud=recolectarDatosGUI("PATCH");

    EnviarInformacion('/'+$('#txtID').val(),ObjSolicitud);

  });
  $(document).ready(function () {
    let campoInput = $('.input-text');
    $("#mostrar-ocultar-input").change(function () {
        if ($(this).is(':checked')) {
            campoInput.hide();
        } else {
            campoInput.show();
        }
    });
  });

  function recolectarDatosGUI(method){

    nuevaSolicitud={

      id:$('#txtID').val(),
      title:$('#txtTitulo').val(),
      SitiosId:$('#txtSitio').val(),
      start:$('#txtFechaStart').val()+" "+$('#txtHoraStart').val(),
      end:$('#textFechaEnd').val()+" "+$('#txtHoraEnd').val(),
      DescripcionSolicitud:$('#txtDescripcion').val(),	
      ObjetosId:$('#txtObjeto').val(),

      
    '_token':$("meta[name='csrf-token']").attr("content"),
    '_method':method

    }
     return (nuevaSolicitud);
    
  }

 

  function EnviarInformacion(accion,objSolicitud){

    $.ajax(
      {
        type:"POST",
        url:"{{ url('/solicitud') }}"+accion,
        data: objSolicitud,
        success:function(msg){
          console.log(accion);
          console.log(objSolicitud);

          
          $('#exampleModal').modal('hide');
          calendar.refetchEvents();

          

          
          
          
          },
        error:function(){Swal.fire("Verifique sus datos");}
      }
    );
  }
});

 
function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }


</script>

@endsection



@section ('contenido')
@include('Home/index')

<div class="row">
    <div class="col"></div>
    <div class="col-9"> <div id="calendar"> </div></div> 
    <div class="col"></div>
</div>

   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reserva de Lugar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <div class="d-none">
        ID:
        <input type="text" class="form-control" name="txtID" id="txtID">
        </br>
        </div>
        Titulo: 
        <input type="text" class="form-control" name="txtTitulo" id="txtTitulo">
        </br> 
        Sitio: 
        <select name="txtSitio" class="form-control" id="txtSitio" class="input-text form-select w-25" required>
                <option value="">Selecciona el Lugar: </option>
                @foreach ($sitios as $sitio)
                <option value="{{$sitio->id}}">{{$sitio->NombreSitios}}</option>
                @endforeach
                </select>
        </br>

        Fecha Inicio:  
        <input type="date" class="form-control" name="txtFechaStart" id="txtFechaStart">
        </br>
       
        Hora de Inicio:
        <input type="time" min="07:00" max="15:00" step="600" class="form-control" name="txtHoraStart" id="txtHoraStart">
        </br>
        
        Fecha Final:  
        <input type="date" class="form-control" name="textFechaEnd" id="textFechaEnd">
        </br>
        Hora de Finalización:
        <input type="time" min="08:00" max="19:00" step="600" class="form-control" name="txtHoraEnd" id="txtHoraEnd">
        </br>
        
        Descripcion del Evento: 
        <textarea name="txtDescripcion" class="form-control" id="txtDescripcion" cols="15" rows="5"></textarea>
        </br>

        
        

        <b>¿Desea Solicitar un Objeto o Herramienta?</b>
        <input type="checkbox" name="check" id="check" value="1" onchange="javascript:showContent()" />
        <div id="content" style="display: none;">
        Objeto: 
        <select name="txtObjeto" class="form-control" id="txtObjeto" class="form-select" required>
                <option value="">Selecciona el Objeto o Herramienta: </option>
                @foreach ($objetos as $objeto)
                <option value="{{$objeto->id}}">{{$objeto->NombreObjetos}}</option>
                @endforeach
                </select>
                </div>
        </br>
        
        
      </div>
      <div class="modal-footer">

      <button id="btnAgregar" class="btn btn-success">Agregar</button>
      <button id="btnModificar" class="btn btn-primary">Modificar</button>     
      <button id="btnEliminar" class="btn btn-warning">Borrar</button>  
      <button id="btnCancelar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>     

    </div>
  </div>
</div>
</div>


@endsection

