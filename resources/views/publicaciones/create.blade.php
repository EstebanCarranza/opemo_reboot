@extends('layouts.master')
<?php
    use App\Http\Models\Publicacion;
  $title = "Crear publicacion";
  $helperEdit = false;
  $publicacion = new Publicacion();
  $publicacion->setIdUbicacion(-1);
  //$publicacion->setPublicacionEstado(3);
  $publicacion->setIdPublicacionEstado(3);
?>
@if(isset($editMode)) 
  @if($editMode)
    <?php
        $publicacion = $publicacionData;
        if($publicacion->getIdPublicacionEstado() == 6)
            $title = "Editar publicacion [BORRADOR]";
        else
            $title = "Editar publicacion";
      $helperEdit = false;
      
    ?>
  @endif
@else
  {{$editMode = false}}
@endif
@section('title', $title)
@section('content')
<style>
.modal
{
    z-index:10;
}
.card-title
{
    z-index:11;
}
</style>
@if($editMode)
  <form id="frmPublicacion"  method="POST" enctype='multipart/form-data' action="{{url('publication-list',[$publicacion->getIdPublicacion()])}}">
    {{ method_field('PATCH') }}
@else
  <form id="frmPublicacion" method="post" enctype='multipart/form-data' action="{{url('publication-list')}}">
@endif

    {{ csrf_field() }}
    <div class ="row">
        <input type="hidden" id="idPublicacion" value="{{$publicacion->getIdPublicacion()}}">
        <input type="hidden" id="editMode" value="{{$editMode}}">
        <input type="hidden" value="3" name="idPublicacionEstado" id="idPublicacionEstado">
    </div>
   
    <div class="row card-panel">
        <div class="col l6">
            @if($editMode)
              <img id="imagen-perfil-vista-previa" class="col l12 s12 materialboxed" src="{{url('/image/publication?id='.$publicacion->getIdPublicacion())}}">
            @else
              <img id="imagen-perfil-vista-previa" class="col l12 s12 materialboxed" src="{{asset('img/default.png')}}">
            @endif
            <output class="col l12 s12 materialboxed" id='list-perfil'></output>
            <div class="col l12 s12">
                <div class="file-field input-field">
                    <div class="btn orange">
                        <span>Cargar</span>
                        <input type="hidden" id="helperEdit" name="helperEdit" value="{{$helperEdit}}">
                        @if($helperEdit)
                          <input id='imagen-publicacion' name='imgPublicacion' type="file" required accept="image/*,video/mp4">
                        @else
                          <input id='imagen-publicacion' name='imgPublicacion' type="file"  accept="image/*,video/mp4">
                        @endif
                        
                    </div>
                    <div class="file-path-wrapper">
                    
                        <input class="file-path validate" type="text" value="Clic aqui para subir tu imagen">
                    </div>
                </div>
            </div>
        </div>
        <div class="col l6 s12 ">
            <h4 class="col s12">
                {{$title}}
            </h4>
            <div class="input-field col s12">
                <input name="titulo" id="pubTitulo" type="text" class="validate" required value="{{$publicacion->getTitulo()}}">
                <label for="pubTitulo">Titulo</label>
            </div>
            <h5 class='card-title flex-content'>Fecha y hora</h5>
                <div class="input-field col l6 s12">
                    <input name="fecha" id="pubFecha" type="text" class="validate datepicker" required value="{{$publicacion->getFecha()}}">
                    <label for="pubFecha">Fecha</label>
                </div>
                <div class="input-field col l6 s12">
                    <input name="hora" id="pubHora" type="text" class="validate timepicker" required value="{{$publicacion->getHora()}}">
                    <label for="pubHora">Hora</label>
                </div>
                 <h5 class='card-title flex-content'>Ubicación</h5>
                <div class="input-field col s12">
                    <input type="hidden" id="selectId" value="{{$publicacion->getIdUbicacion()}}">
                    <select class="insert-ubicacion" name="ubicacion" id="cbxUbicacion">    
                    </select>
                    <label>Elige una ubicación</label>
                </div>
                

            <h5 class='card-title flex-content'>Descripción larga</h5>
                <div class="input-field col s12">
                <textarea name="descripcionLarga" id="epDescripcionLarga" class="materialize-textarea" data-length="120">{{$publicacion->getDescripcion()}}</textarea>
                <label for="epDescripcionLarga">Escribe la descripción larga</label>
            </div>
        </div>
        <button id="btnBorrador" class=" btn waves-effect waves-light orange col l6 offset-l6 s12 row" name="action" type="button">
            Guardar como borrador
            <i id="iconBtnBorrador" class="material-icons right">send</i>
        </button>

        <button id="btnCrear" class="btn waves-effect waves-light orange col l6 offset-l6 s12 row" name="action" type="submit">Publicar
            <i class="material-icons right">send</i>
        </button>
    </div>
</form>
  

  <!-- Modal Structure -->
  <div id="mdlMensaje" class="modal">
    <div class="modal-content">
      <h3>No tienes ninguna ubicacion :(</h3>
      <h4 class="red-text">No puedes crear publicaciones si no has creado previamente al menos una ubicación, ¿Quieres capturar una ubicación?</h4>
      <br>
      <div class="row">
        <a href="/ubications/create" class="col s12 large orange waves-effect waves-light btn">Crear una ubicación</a>
      </div>
      <div class="row">
        <a href="/dashboard" class="col s12 large orange waves-effect waves-light btn">Regresar al dashboard</a>
      </div>
    </div>
  </div>

 <script>
$(document).ready(function(){
    $('.modal').modal();
    
    
    $('.datepicker').datepicker({
        autoClose : true,
        format : 'yyyy-mm-dd'
    });//'dd/mm/yyyy'
    $('.timepicker').timepicker({
        twelveHour : false
    });
    $('select').formSelect();
    $('input#input_text, textarea#epDescripcionLarga').characterCounter();
    $('.materialboxed').materialbox();
    $("#btnCrear").addClass("disabled");
    $("#btnBorrador").click(function()
    {
        if($("#editMode").val())
            agregarBorradorEditado();
        else
            agregarBorradorCreado();
    });
    function validar_edit()
    {
      
      if(
          $("#cbxUbicacion").find(":selected").val() != -1 && 
          $("#pubTitulo").val() != "" && 
          $("#pubFecha").val() != "" &&
          $("#pubHora").val() != "" &&
          $("#epDescripcionLarga").val() != "" 
        )
          $("#btnCrear").removeClass("disabled");
        else
          $("#btnCrear").addClass("disabled");
          
    }
    $("select[name=ubicacion]").change(function()
    {
     $("#btnCrear").removeClass("disabled");
    });

    $("#pubTitulo").keyup(function(){validar_edit();}) ;
    $("#pubFecha").keyup(function(){validar_edit();});
    $("#pubHora").keyup(function(){validar_edit();});
    $("#epDescripcionLarga").keyup(function(){validar_edit();});

    getUbicaciones();
    function getUbicaciones()
    {
      $.ajax({
            url: '/data/ubication/',
            async: 'true',
            type: 'GET',
            dataType: 'json',
            success: function (respuesta) {
                
                if(respuesta.length == 0)
                {
                    $("#mdlMensaje").modal('open');
                    $("#btnCrear").hide();
                    $("#btnBorrador").hide();


                }
                else
                {
                    var idCiudadSelected = $("#selectId").val();
                    if(idCiudadSelected == -1)
                        $(".insert-ubicacion").append("<option selected value='-1' disabled>Elige una ubicación</option>");
                    else
                        $(".insert-ubicacion").append("<option value='-1' disabled>Elige una ubicación</option>");
                        for(var i = 0; i < respuesta.length; i++)
                        {
                            //agregar el option al combo de html
                            if(idCiudadSelected == respuesta[i].idUbicacion)                
                                $(".insert-ubicacion").append("<option selected value='"+respuesta[i].idUbicacion+"'>"+respuesta[i].titulo+"</option>");
                            else
                                $(".insert-ubicacion").append("<option value='"+respuesta[i].idUbicacion+"'>"+respuesta[i].titulo+"</option>");
                            //actualizar el combobox de materialized
                            $('select').formSelect();
                        } 
                }
            },
            error: function (x, h, r) {
                alert("Error: " + x + h + r);

            }
        });
    }
    /*getCiudades();
    function getCiudades()
    {
      $.ajax({
            url: '/Ciudad/',
            async: 'true',
            type: 'GET',
            dataType: 'json',
            success: function (respuesta) {
                for(var i = 0; i < respuesta.length; i++)
                {
                    //agregar el option al combo de html
                    $(".insert-ciudad").append("<option value='"+respuesta[i].idCiudad+"'>"+respuesta[i].titulo+"</option>");
                    //actualizar el combobox de materialized
                    $('select').formSelect();
                } 
            },
            error: function (x, h, r) {
                alert("Error: " + x + h + r);

            }
        });
    }*/

    function agregarBorradorEditado()
    {
        var titulo = $("#pubTitulo").val();
        var fecha = $("#pubFecha").val();
        var hora = $("#pubHora").val();
        var idUbicacion = $("#cbxUbicacion").find(":selected").val();
        var descripcion = $("#epDescripcionLarga").val();
        //var idPublicacionEstado = $("#idPublicacionEstado").val();
        var idPublicacionEstado = 6;
        var imagen = $("#imagen-publicacion").serialize();
        var token = '{{csrf_token()}}';
        var ajax = true;
        var data = {
                    _token:token,
                    titulo:titulo,
                    fecha:fecha,
                    hora:hora,
                    ubicacion:idUbicacion,
                    descripcionLarga:descripcion,
                    idPublicacionEstado:idPublicacionEstado,
                    imgPublicacion:imagen,
                    borrador:true,
                    editMode:$("#editMode").val(),
                    id:$("#idPublicacion").val(),
                     _method: "PATCH",
                     ajax
                };

        
      $.ajax({
        url: '/publication-list/'+$("#idPublicacion").val(),
        async: 'true',
        type: 'PATCH',
        data: data,
        success: function (respuesta) {
           //debugger;
           $("#iconBtnBorrador").html("check");
           $("#btnBorrador").addClass("green");
           $("#btnBorrador").removeClass("orange");
           $("#btnBorrador").html("Guardado como borrador");
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }

     function agregarBorradorCreado()
    {
        var titulo = $("#pubTitulo").val();
        var fecha = $("#pubFecha").val();
        var hora = $("#pubHora").val();
        var idUbicacion = $("#cbxUbicacion").find(":selected").val();
        var descripcion = $("#epDescripcionLarga").val();
        //var idPublicacionEstado = $("#idPublicacionEstado").val();
        var idPublicacionEstado = 6;
        var imagen = $("#imagen-publicacion").serialize();
        var token = '{{csrf_token()}}';
        var ajax = true;
        var data = {
                    _token:token,
                    titulo:titulo,
                    fecha:fecha,
                    hora:hora,
                    ubicacion:idUbicacion,
                    descripcionLarga:descripcion,
                    idPublicacionEstado:idPublicacionEstado,
                    imgPublicacion:imagen,
                    borrador:true,
                    editMode:$("#editMode").val(),
                    id:$("#idPublicacion").val(),
                     _method: "POST",
                     ajax
                };

        
      $.ajax({
        url: '/publication-list/',
        async: 'true',
        type: 'POST',
        data: data,
        success: function (respuesta) {
           //debugger;
           $("#iconBtnBorrador").html("check");
           $("#btnBorrador").addClass("green");
           $("#btnBorrador").removeClass("orange");
           $("#btnBorrador").html("Guardado como borrador");
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }
    
  });
  </script>
  <script>		
function archivo_perfil(evt) 
    {
        var files = evt.target.files; // FileList object
        var objectType = 0;
        //Obtenemos la imagen del campo "file". 
        for (var i = 0, f; f = files[i]; i++) 
        {         
            ////Solo admitimos imágenes.
            //if ((!f.type.match('image.*')) || (!f.type.match('video.*')))// || !f.type.match('video.*'))
            //{
            //continue;
            //}
                if(f.type.match('image.*'))
                {
                    objectType = 1;
                }
                if(f.type.match('video.*'))
                {
                    objectType = 2;
                }
            
                var reader = new FileReader();
                reader.onload = (function(theFile) 
                {
                    return function(e) 
                    {
                        var element = document.getElementById("btnCrear");
                        element.classList.remove("disabled");
                        $helperEdit = true;
                        // Creamos la imagen.
                        document.getElementById('imagen-perfil-vista-previa').style.display = 'none';
                        
                        if(objectType == 1)
                            document.getElementById("list-perfil").innerHTML = ['<img width="100%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');    
                        
                        if(objectType==2)
                            document.getElementById("list-perfil").innerHTML = ['<video controls width="100%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');    
                    };
            })(f);
            reader.readAsDataURL(f);
            
        }
    }
    
    document.getElementById('imagen-publicacion').addEventListener('change', archivo_perfil, false);
					
</script>
@stop

