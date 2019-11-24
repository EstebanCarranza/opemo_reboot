@extends('layouts.master')
<?php /*create and edit mode (editMode = true)*/ ?>
<?php
  $title = "Crear ubicacion";
  $nombreUbicacion = "";
  $descripcionLarga ="";
  $idMunicipio = -1;
  $helperEdit = false;
?>
@if(isset($editMode)) 
  @if($editMode)
    <?php
      $title = "Editar ubicacion";
      $nombreUbicacion = $ubicacion->getTitulo();
      $descripcionLarga = $ubicacion->getDescripcion();
      $idMunicipio = $ubicacion->getIdCiudad();
      $helperEdit = false;
    ?>
  @endif
@else
  {{$editMode = false}}
@endif
@section('title', $title)
@section('content')
@if($editMode)
  <form  method="POST" enctype='multipart/form-data' action="{{url('ubications',[$ubicacion->getIdUbicacion()])}}">
    {{ method_field('PATCH') }}
@else
  <form method="post" enctype='multipart/form-data' action="{{url('ubications')}}">
@endif
    {{ csrf_field() }}
    <div class="row card-panel">
    <div class="col l6">
            @if($editMode)
              <img id="imagen-ubicacion-vista-previa" class="col l12 s12 materialboxed" src="{{url('/image/ubication?id='.$ubicacion->getIdUbicacion())}}">
            @else
              <img id="imagen-ubicacion-vista-previa" class="col l12 s12 materialboxed" src="{{asset('img/default.png')}}">
            @endif
            
            <output class="col l12 s12 materialboxed" id='list-perfil'></output>
            <div class="col l12 s12">
                <div class="file-field input-field">
                    <div class="btn orange">
                        <span>Cargar</span>
                        <input type="hidden" id="helperEdit" name="helperEdit" value="{{$helperEdit}}">
                        @if($helperEdit)
                          <input id='imagen-ubicacion' name='imgUbicacion' type="file" required accept="image/*">
                        @else
                          <input id='imagen-ubicacion' name='imgUbicacion' type="file"  accept="image/*">
                        @endif
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" value="Clic aqui para subir tu imagen">
                    </div>
                </div>
            </div>
        </div>
      <div class="col l6 s12">
        <h4 class="col s12">
          {{$title}}
        </h4>
        <div class="col s12">
          <div class="input-field col s12">
            <input id="pubCrearUbicacion" name="titulo" type="text" class="validate" value="{{$nombreUbicacion}}" required>
            <label for="pubCrearUbicacion">Escribe la ubicación</label>
          </div>
        </div>
        <div class="col s12">
          <div class="input-field col s12">
            <textarea name="descripcionLarga" id="epDescripcionLarga" class="materialize-textarea" data-length="1000" required>{{$descripcionLarga}}</textarea>
            <label for="epDescripcionLarga">Escribe la descripción larga</label>
          </div>
        </div>
        <div class="col s12">
          <div class="input-field col s12">
            <input type="hidden" id="selectId" value="{{$idMunicipio}}">
            <select name="municipio" class="insert-ciudad" id="cbxCiudades">
              
            </select>
            <label>Elige un municipio</label>
          </div>
        </div>
        <div class="col s12">
            <button id="btnCrear" class="btn waves-effect waves-light orange col s12 row" name="action" type="submit">Guardar ubicación
              <i class="material-icons right">send</i>
            </button>   
        </div>
      </div>
    </div>
  </form>
  <script>
$(document).ready(function(){
   
    $('select').formSelect();
    $('input#input_text, textarea#epDescripcionLarga').characterCounter();
    $('.materialboxed').materialbox();
    getCiudades();
    $("#btnCrear").addClass("disabled");
    function validar_edit()
    {
      
      if(
          $("#cbxCiudades").find(":selected").val() != -1 && 
          $("#pubCrearUbicacion").val() != "" && 
          $("#epDescripcionLarga").val() != ""
        )
          $("#btnCrear").removeClass("disabled");
        else
          $("#btnCrear").addClass("disabled");
          
    }
    
    $("select[name=municipio]").change(function()
    {
      
      validar_edit(); 
    });
    $("#pubCrearUbicacion").keyup(function()
    {
      validar_edit();
      
    });
    $("#epDescripcionLarga").keyup(function()
    {
      validar_edit();
    });
    function getCiudades()
    {
      $.ajax({
        url: '/Ciudad',
        async: 'true',
        type: 'GET',
        dataType: 'json',

        success: function (respuesta) {
          var idCiudadSelected = $("#selectId").val();
          if(idCiudadSelected == -1)
            $(".insert-ciudad").append("<option selected value='-1' disabled>Elige un municipio</option>");
          else
            $(".insert-ciudad").append("<option value='-1' disabled>Elige un municipio</option>");
          
          for(var i = 0; i < respuesta.length; i++)
          {
            //agregar el option al combo de html
            if(idCiudadSelected == respuesta[i].idCiudad)
              $(".insert-ciudad").append("<option selected value='"+respuesta[i].idCiudad+"'>"+respuesta[i].titulo+"</option>");
            else
              $(".insert-ciudad").append("<option value='"+respuesta[i].idCiudad+"'>"+respuesta[i].titulo+"</option>");
            //actualizar el combobox de materialized
            $('select').formSelect();

          } 
          
            //$(".insert-ciudad").html(respuesta);
            //debugger;
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
                        //Activar la edición de la imagen
                        $("#helperEdit").val(true);
                        // Creamos la imagen.
                        document.getElementById('imagen-ubicacion-vista-previa').style.display = 'none';
                        
                        if(objectType == 1)
                            document.getElementById("list-perfil").innerHTML = ['<img width="100%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');    
                        
                        if(objectType==2)
                            document.getElementById("list-perfil").innerHTML = ['<video controls width="100%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');    
                    };
            })(f);
            reader.readAsDataURL(f);
            
        }
    }
    
    document.getElementById('imagen-ubicacion').addEventListener('change', archivo_perfil, false);
					
</script>
@stop