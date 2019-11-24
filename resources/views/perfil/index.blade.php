@extends('layouts.master')
@section('content')

<div class="col s12 row cover-main">
  <div class="cover" >
    <div><!-- <PORTADA> -->
      @if(isset($me))
        <img src="{{url('/image/profile/cover?id='.$usuario->getIdUsuario())}}" class="ec-img-cover ec-img-shadow-profile" style="width:100%;">
        <button data-target="modal_edit_image_cover" class="btn modal-trigger ec-btn-file-input-cover orange">
          <i class="material-icons">mode_edit</i>
        </button>
        @include('perfil.edit-cover')
      @else
        <img id="imagen-ubicacion-vista-previa" src="{{url('/image/profile/cover?id='.$usuario->getIdUsuario())}}" class="ec-img-cover" style="width:100%;">
        <div class="col row offset-s8 ec-cover-ubication-follow" style="width:100%;">
         @if(isset($seguir))
            {{csrf_field()}}  
            <input id="idUsuarioSiguiendo" type="hidden" name="idUsuarioSiguiendo" value="{{$usuario->getIdUsuario()}}">
            <button id="btnSeguir" class="btn col s3 row waves-effect waves-green orange" type="submit" name="action">
                @if($seguir)
                  Dejar de seguir
                @else
                    Seguir
                @endif
            </button>
          @endif
        </div>
      @endif
    </div><!-- </PORTADA> -->
    
    <!-- <AVATAR> -->
    @if(isset($me))
     <img  src="{{url('/image/profile/avatar?id='.$usuario->getIdUsuario())}}" class="ec-img-avatar ec-img-profile ec-img-shadow-profile">
      <button data-target="modal_edit_image_avatar" class="btn modal-trigger ec-btn-file-input orange">
        <i class="material-icons">mode_edit</i>
      </button>
      @include('perfil.edit-avatar')    
    @else
      <img  src="{{url('/image/profile/avatar?id='.$usuario->getIdUsuario())}}" class="ec-img-avatar ec-img-profile">

    @endif
    <!-- </AVATAR> -->
  </div>
</div>
    <div class="card-panel row col s12">
      <div class="col s12">
        <ul class="tabs">
          @if(isset($me))
            <li class="tab col s3"><a class="" href="#test1">Información</a></li>
            <li class="tab col s3"><a class="" href="#test2">Seguridad</a></li>
            <li class="tab col s3 " id="getSeguidores"><a class="" href="#test3">Seguidores</a></li>
            <li class="tab col s3" id="getSeguidos"><a href="#test4">Seguidos</a></li>
          @else
            @if(!Auth::guest())
              <li class="tab col s4"><a class="" href="#test1">Información</a></li>
              <li class="tab col s4" id="getSeguidores"><a class="" href="#test3">Seguidores</a></li>
              <li class="tab col s4" id="getSeguidos"><a href="#test4">Seguidos</a></li>
            @else
              <li class="tab col s12"><a class="" href="#test1">Información</a></li>
            @endif
          @endif
        
        </ul>
      </div>
      <div id="test1" class="col s12 row">
       @if(isset($me))
        <form  method="POST" action="{{url('profile',[$usuario->getIdUsuario()])}}">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
          <input type="hidden" name="ecAction" value="edit-info">
        @endif
          <div class="col l6 m6 s12">
            <h1> Bio </h1>
            <div class="input-field col s12 flow-text">
              <input name="bio" id="pBio" type="text" class="validate ecInputEdit" value="{{$usuario->getBio()}}">
              <label for="pBio">Escribe tu bio</label>
            </div>
            <div class="col s12">
                <i id="star-1" value="1" class='medium star black-text material-icons'>star</i>
                <i id="star-2" value="2" class='medium star black-text material-icons'>star</i>
                <i id="star-3" value="3" class='medium star black-text material-icons'>star</i>
                <i id="star-4" value="4" class='medium star black-text material-icons'>star</i>
                <i id="star-5" value="5" class='medium star black-text material-icons'>star</i>
            </div>
          </div>
          <p>&nbsp;</p>
          <div class="col l6 s12">
            <div class="input-field col l12 m6 s12">
              <input name="alias" id="pAlias" type="text" class="validate ecInputEdit" value="{{$usuario->getAlias()}}">
              <label for="pAlias">Alias</label>
            </div>
            <div class="input-field col l12 m6 s12">
              <input name="nombre" id="pNombre" type="text" class="validate ecInputEdit" value="{{$usuario->getNombre()}}">
              <label for="pNombre">Nombre</label>
            </div>
            <div class="input-field col l12 m6 s12">
              <input name="apellidoPaterno" id="pApellido" type="text" class="validate ecInputEdit" value="{{$usuario->getApellidoPaterno()}}">
              <label for="pApellido">Apellido</label>
            </div>
            <div class="input-field col l12 m6 s12">
              <input name="correo" id="pCorreo" type="text" class="validate ecInputEdit" value="{{$usuario->getCorreo()}}">
              <label for="pCorreo">Correo electrónico</label>
            </div>
            <div class="input-field col l12 m6 s12">
              <input name="fechaNacimiento" id="pFechaNac" type="text" class="datepicker ecInputEdit" value="{{$usuario->getFechaNacimiento()}}">
              <label for="pFechaNac">Fecha de nacimiento</label>
            </div>
          @if(isset($me))
            <div class="input-field col l6 s12 row offset-l6">
              <a id="btnEdit" class="waves-effect waves-light btn col l5 s5 primary-color orange">
                <i class="material-icons">mode_edit</i>
              </a>
              <label class="col l1 s1">&nbsp;</label>
              <button id="btnSave"  class="btn waves-effect waves-light col l6 s6 offset-l1 offset-s1 primary-color orange ecButtonEdit" type="submit" name="action">
                <i class="material-icons">save</i>
              </button>
            </div>     
          @endif
          </div>
      @if(isset($me))
        </form>
      @endif
      </div>
      @if(isset($me))
      <div id="test2" class="col l12 s12">
       <form  method="POST" action="{{url('profile',[$usuario->getIdUsuario()])}}">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
          <input type="hidden" name="ecAction" value="edit-password">
          <h4 class="col s12">Cambiar contraseña </h4>
          <div class="input-field col l6 s12">
            <input name="password" id="pContrasenia01" type="password" class="validate ecInputEdit">
            <label for="pContrasenia01">Contraseña</label>
          </div>
          <div class="input-field col l6 s12">
            <input id="pContrasenia02" type="password" class="validate ecInputEdit">
            <label for="pContrasenia02">Repetir contraseña</label>
          </div>
          <div class="input-field col l6 s12 row offset-l6">
              <a title="Editar información" id="btnEditPassword" class="waves-effect waves-light btn col l3 s12 offset-l1 primary-color orange">
                <i class="material-icons">mode_edit</i>
              </a>
              <a title="Mostrar/ocultar contraseñas" id="btnShowPassword" class="waves-effect waves-light btn col l3 s12 offset-l1 primary-color orange">
                <i class="material-icons" id="iconShowPassword">visibility</i>
              </a>
              <button title="Guardar contraseña" id="btnSavePassword" class="btn waves-effect waves-light col l3 s12 offset-l1 primary-color orange ecButtonEdit" type="submit" name="action">
                <i class="material-icons">save</i>
              </button>
          </div>       
        </form>
      </div>
      @endif
      <div id="test3" class="">
          <div id="listSeguidores" class="row">
          </div>
      </div>
      <div id="test4" class="col s12">
         <div id="listSeguidos" class="row">
          </div>
      </div>

    </div>
          
  
<script>
  $(document).ready(function()
  {
    $('.datepicker').datepicker({
      autoClose : true,
      format : 'yyyy-mm-dd'
    });//'dd/mm/yyyy'
    $('.tabs').tabs(
      {
       /* swipeable : true*/
      }
    );

    var timeMouseoutProfilePicture = 100;
    $(".ec-btn-file-input").hide();
    $(".ec-btn-file-input-cover").hide();

    $(".ec-img-profile").click(function()
    {
      $(".ec-btn-file-input").toggle();
      
    });
   
    var editMode = false;
    function habilitar_controles(habilitar)
    {
      if(habilitar)
      {
        $(".ecInputEdit").removeAttr("disabled");
        $(".ecButtonEdit").removeClass("disabled");
        /*
        $("#pAlias").removeAttr("disabled");
        $("#pNombre").removeAttr("disabled");
        $("#pBio").removeAttr("disabled");
        $("#pApellido").removeAttr("disabled");
        $("#pCorreo").removeAttr("disabled");
        $("#pContrasenia").removeAttr("disabled");
        $("#pContraseniaRep").removeAttr("disabled");
        $("#pFechaNac").removeAttr("disabled");
        $("#btnSave").removeClass("disabled");
        */
      }
      else{
        $(".ecInputEdit").prop("disabled",true);
        $(".ecButtonEdit").addClass("disabled");
        /*
        $("#pAlias").prop("disabled",true);
        $("#pNombre").prop("disabled",true);
        $("#pBio").prop("disabled",true);
        $("#pApellido").prop("disabled",true);
        $("#pCorreo").prop("disabled",true);
        $("#pContrasenia").prop("disabled",true);
        $("#pContraseniaRep").prop("disabled",true);
        $("#pFechaNac").prop("disabled",true);
        $("#btnSave").addClass("disabled");
        */
      }
       
    }
    var showPassword = false;
    $("#btnShowPassword").click(function()
    {
      if(showPassword)
      {
        $("#pContrasenia01").prop("type","password"); 
        $("#pContrasenia02").prop("type","password"); 
        $("#iconShowPassword").html("visibility");
      }
      else
      {
        $("#pContrasenia01").prop("type","text"); 
        $("#pContrasenia02").prop("type","text"); 
        $("#iconShowPassword").html("visibility_off");
      }
      showPassword = !showPassword;
      
    });
    var editModePassword = false;
    function habilitar_controles_seguridad(habilitar)
    {
      if(habilitar)
      {
        $("#pContrasenia01").removeAttr("disabled");
        $("#pContrasenia02").removeAttr("disabled");
        $("#btnSavePassword").removeClass("disabled");
      }
      else
      {
        $("#pContrasenia01").prop("disabled",true);
        $("#pContrasenia02").prop("disabled",true);
        $("#btnSavePassword").addClass("disabled");
      }
    }
    habilitar_controles_seguridad(false);
    habilitar_controles(false);
    $("#btnEdit").click(function()
    {
      if(!editMode)
      {
        $(this).html('<i class="material-icons">cancel</i>');
        editMode = true;
        habilitar_controles(true);
       
      }else
      {
        $(this).html('<i class="material-icons">mode_edit</i>');
        editMode = false;
        habilitar_controles(false);
        
      } 
    });
    $("#btnEditPassword").click(function()
    {
      if(!editModePassword)
      {
        $(this).html('<i class="material-icons">cancel</i>');
        editModePassword = true;
        habilitar_controles_seguridad(true);
        $("#btnSavePassword").addClass("disabled");
       
      }else
      {
        $(this).html('<i class="material-icons">mode_edit</i>');
        editModePassword = false;
        habilitar_controles_seguridad(false);
        $("#pContrasenia01").val("");  
        $("#pContrasenia02").val("");
      }
    });
    $(".ec-img-cover").on('click', function()
    {
      $(".ec-btn-file-input-cover").toggle();
      
    });
    $(".ec-img-avatar").on('click', function()
    {
      $(".ec-btn-file-input-avatar").toggle();
      
    });
    var inputContrasenia01 = false;
    var inputContrasenia02 = false;
    
    function validarContrasenias(validar)
    {
      if(validar)
        if(($("#pContrasenia01").val() != "") && ($("#pContrasenia02").val() != ""))
        {
          if($("#pContrasenia01").val() == $("#pContrasenia02").val())
            $("#btnSavePassword").removeClass("disabled");
          else
            $("#btnSavePassword").addClass("disabled");  
        }
        else
            $("#btnSavePassword").addClass("disabled");  
    }

    $("#pContrasenia01").keyup(function()
    {
      validarContrasenias(true);
      
    });
    $("#pContrasenia02").keyup(function()
    {
      validarContrasenias(true);
     
    });
    function setEvent()
    {
      $(".ec-img-cover").on('click', function()
      {
        $(".ec-btn-file-input-cover").toggle();
        
      });
    }
  $("#btnSeguir").click(function()
  {
    seguirUsuario();
  });
    function seguirUsuario()
    {
        var idUsuarioSiguiendo = $("#idUsuarioSiguiendo").val();
        var token = '{{csrf_token()}}';
        var data = {
                    idUsuarioSiguiendo:idUsuarioSiguiendo,
                    _token:token
                };
        
      $.ajax({
        url: '/seguir',
        async: 'true',
        type: 'POST',
        data: data,
        success: function (respuesta) {
          //debugger;
          if(respuesta[0])
          {
            $("#btnSeguir").html("Seguir");
          }else
          {
            $("#btnSeguir").html("Dejar de seguir");
          }
          
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }

    $("#getSeguidores").click(function(){
      getSeguidores();
    });
    function getSeguidores()
    {
      var dataToSend = {
        id:{{$usuario->getIdUsuario()}}
      };
      $.ajax({
        url: '/seguidores',
        async: 'true',
        data:dataToSend,
        type: 'get',
        success: function (respuesta) {
          debugger;
          $("#listSeguidores").html("");
          for(var i= 0; i < respuesta.length; i++)
          {
            var card = 
            "<div class='col l4 m6 s12 animated-card card-row-custom-size'>"+
              "<div class='card small hoverable card-custom-size'>"+
                  "<div class='card-image waves-effect waves-block waves-light'>"+
                      "<img class='activator' src='/image/profile/cover?id="+respuesta[i].idUsuarioSeguidor+"'>"+
                      "<img class='activator ec-img-seguidor' src='/image/profile/avatar?id="+respuesta[i].idUsuarioSeguidor+"'>"+
                  "</div>"+
                  "<div class='card-content'>"+
                      "<a href='#' class=''><i class='material-icons right activator'>more_vert</i></a>"+
                      "<span class='card-title  grey-text text-darken-4 truncate'>"+respuesta[i].nombreSeguidor+"</span>"+
                       "<p>"+
                          "<a href='profile/"+respuesta[i].idUsuarioSeguidor+"'>Ir al perfil</a>"+
                      "</p>"+
                      "<div class='card-footer'>"+
                          "<small class='text-muted truncate'>"+
                             respuesta[i].antiguedad + "&nbsp;"+
                          "</small>"+
                      "</div>"+
                  "</div>"+
                  "<div class='card-reveal'>"+
                      "<div><i class='material-icons right card-title'>close</i></div>"+
                      "<span class='card-title grey-text text-darken-4'>"+respuesta[i].nombreSeguidor+"</span>"+
                      "<div class='row'>"+
                      "<p class='col s12'>"+
                          "<a class='col s12' href='profile/"+respuesta[i].idUsuarioSeguidor+"'>Ir al perfil</a>"+
                      "</p>"+
                      "<p class='col s12'>"+
                          "<a class='col s12' href='profile/"+respuesta[i].idUsuarioSeguidor+"'>Ir al perfil</a>"+
                      "</p>"+
                      "<p class='col s12'>"+
                          "<a class='col s12' href='profile/"+respuesta[i].idUsuarioSeguidor+"'>Ir al perfil</a>"+
                      "</p>"+
                      "</div>"+
                      "<div class='card-footer'>"+
                          "<small class='text-muted truncate'>"+
                             respuesta[i].antiguedad +
                          "</small>"+
                      "</div>"+
                  "</div>"+
              "</div>"+
            "</div>";
            $("#listSeguidores").append(card);

          }
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

      });
    }
    $("#getSeguidos").click(function(){
      getSeguidos();
    });
    function getSeguidos()
    {
      var dataToSend = {
        id:{{$usuario->getIdUsuario()}}
      };     
      $.ajax({
        url: '/seguidos',
        async: 'true',
        data:dataToSend,
        type: 'get',
        success: function (respuesta) {
          $("#listSeguidos").html("");
          for(var i= 0; i < respuesta.length; i++)
          {
            var card = 
            "<div class='col l4 m6 s12 animated-card card-row-custom-size'>"+
              "<div class='card small hoverable card-custom-size'>"+
                  "<div class='card-image waves-effect waves-block waves-light'>"+
                      "<img class='activator' src='/image/profile/cover?id="+respuesta[i].idUsuarioSiguiendo+"'>"+
                      "<img class='activator ec-img-seguidor' src='/image/profile/avatar?id="+respuesta[i].idUsuarioSiguiendo+"'>"+
                  "</div>"+
                  "<div class='card-content'>"+
                      "<a href='#' class=''><i class='material-icons right activator'>more_vert</i></a>"+
                      "<span class='card-title  grey-text text-darken-4 truncate'>"+respuesta[i].nombreSiguiendo+"</span>"+
                      "<p>"+
                        
                          "<a href='profile/"+respuesta[i].idUsuarioSiguiendo+"'>Ir al perfil</a>"+
                      "</p>"+
                      "<div class='card-footer'>"+
                          "<small class='text-muted truncate'>"+
                             respuesta[i].antiguedad + "&nbsp;"+
                          "</small>"+
                      "</div>"+
                  "</div>"+
                  "<div class='card-reveal'>"+
                      "<div><i class='material-icons right card-title'>close</i></div>"+
                      "<span class='card-title grey-text text-darken-4'>"+respuesta[i].nombreSiguiendo+"</span>"+
                      "<p class='flow-text'>"+
                      "</p>  "+
                      "<div class='card-footer'>"+
                          "<small class='text-muted truncate'>"+
                             respuesta[i].antiguedad +
                          "</small>"+
                      "</div>"+
                  "</div>"+
              "</div>"+
            "</div>";
            $("#listSeguidos").append(card);

          }
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);
        }
      });
    }


getPuntuacion();
    function getPuntuacion()
    {
      $.ajax({
        url: "{{url('/puntuacion-total?id='.$usuario->getIdUsuario())}}",
        async: 'true',
        type: 'GET',
        dataType: 'json',

        success: function (respuesta) {
            
            $(".star").removeClass("black-text");
            $(".star").removeClass("orange-text");
          var data = respuesta.puntuacion;
          estrellas = 0;
          switch(data)
          {
            case "1": {
             // debugger;
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("black-text");
              $("#star-3").addClass("black-text");
              $("#star-4").addClass("black-text");
              $("#star-5").addClass("black-text");
              estrellas = 1;
              }
            break;
            case "2": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("black-text");
              $("#star-4").addClass("black-text");
              $("#star-5").addClass("black-text");
              estrellas = 2;
              }
            break;
            case "3": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("orange-text");
              $("#star-4").addClass("black-text");
              $("#star-5").addClass("black-text");
              estrellas = 3;
              }
            break;
            case "4": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("orange-text");
              $("#star-4").addClass("orange-text");
              $("#star-5").addClass("black-text");
              estrellas = 4;
              }
            break;
            case "5": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("orange-text");
              $("#star-4").addClass("orange-text");
              $("#star-5").addClass("orange-text");
              estrellas = 5;
              }
            break;
            default:{
                $("#star-1").addClass("black-text");
                $("#star-2").addClass("black-text");
                $("#star-3").addClass("black-text");
                $("#star-4").addClass("black-text");
                $("#star-5").addClass("black-text");
                estrellas = 0;
            }break;
          }
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
    }   

  });
</script>
@stop