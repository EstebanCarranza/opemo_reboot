@extends('layouts.master')
@section('content')
<h4 class="center">Reclamos de objetos</h4>
<div id="listMessage"></div>
      

<!-- Modal Structure -->
  <div id="modPuntuacion" class="modal">
    <div class="modal-content">
      <h4>Marcar objeto como recuperado</h4>
      <h5>
        Gracias por finalizar el proceso de recuperación de objetos a continuación por favor 
        califica a <ec-label class="orange-text" id="recUsuario"></ec-label> que te ayudó a recuperar <ec-label class="orange-text" id="recObjeto"></ec-label>
      </h5>
      <h1 class="center">
        <i id="star-1" value="1" style="cursor:pointer;" class='medium star orange-text material-icons'>star</i>
        <i id="star-2" value="2" style="cursor:pointer;" class='medium star orange-text material-icons'>star</i>
        <i id="star-3" value="3" style="cursor:pointer;" class='medium star orange-text material-icons'>star</i>
        <i id="star-4" value="4" style="cursor:pointer;" class='medium star black-text material-icons'>star</i>
        <i id="star-5" value="5" style="cursor:pointer;" class='medium star black-text material-icons'>star</i>
      </h1>
      <p class="center orange-text" id="star-text"></p>
      <p class="center orange-text" id="star-text-data"></p>
      <input type="hidden" name="idUsuario" id="txtIdUsuario">
      <input type="hidden" name="idPublicacion" id="txtIdPublicacion">
    </div>
    <div class="modal-footer">
     <a id="btnEnviarPuntuacion" class="modal-close waves-effect waves-green btn-flat">Enviar puntuación</a>     
    </div>
  </div>
  <!-- Modal Structure -->
  <div id="msgReporte" class="modal white green-text">
    <div class="modal-content center">
      
        <i class="material-icons large  green-text">check_circle</i>
        <h5 id="msgReporteTitle">Reporte realizado correctamente</h5>
    </div>
    <div class="modal-footer white green-text">
      <a href="#!" class="modal-close waves-effect waves-orange btn-flat orange-text">Cerrar</a>
    </div>
  </div>
<script>    
    $(document).ready(function()
    {
      $('.modal').modal();
      var estrellas = 3;
      function enviarPuntuacion()
      {
        
        var data = {
                    _token:'{{csrf_token()}}',
                    idUsuario:$("#txtIdUsuario").val(),
                    idPublicacion:$("#txtIdPublicacion").val(),
                    puntuacion:estrellas
                };

        
      $.ajax({
        url: '/puntuacion',
        async: 'true',
        type: 'POST',
        data: data,
        success: function (respuesta) {
          // debugger;   
          $("#msgReporteTitle").html("Gracias por puntuar al usuario y finalizar la recuperación de tu objeto :)");
          $("#msgReporte").modal('open');
           getPublicationReclam();
        },
        error: function (x, h, r) {
            alert("Error: " + x + h + r);

        }

        });
      }
      $("#btnEnviarPuntuacion").click(function()
      {
        debugger;
        enviarPuntuacion();
      });

        $(".star").click(function(){
          $(".star").removeClass("black-text");
          $(".star").removeClass("orange-text");
          var data = $(this).attr('value');
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
              $("#star-text").html("1 estrella");
              $("#star-text-data").html("No me gustó");
              estrellas = 1;
              }
            break;
            case "2": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("black-text");
              $("#star-4").addClass("black-text");
              $("#star-5").addClass("black-text");
              $("#star-text").html("2 estrellas");
              $("#star-text-data").html("Me parece bien, pero le falta algo");
              estrellas = 2;
              }
            break;
            case "3": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("orange-text");
              $("#star-4").addClass("black-text");
              $("#star-5").addClass("black-text");
              $("#star-text").html("3 estrellas");
              $("#star-text-data").html("Estuvo bien");
              estrellas = 3;
              }
            break;
            case "4": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("orange-text");
              $("#star-4").addClass("orange-text");
              $("#star-5").addClass("black-text");
              $("#star-text").html("4 estrellas");
              $("#star-text-data").html("Excelente");
              estrellas = 4;
              }
            break;
            case "5": {
              $("#star-1").addClass("orange-text");
              $("#star-2").addClass("orange-text");
              $("#star-3").addClass("orange-text");
              $("#star-4").addClass("orange-text");
              $("#star-5").addClass("orange-text");
              $("#star-text").html("5 estrellas");
              $("#star-text-data").html("¡Es lo mejor del mundo!");
              estrellas = 5;
              }
            break;
            default:break;
          }
        });
        
        getPublicationReclam();
        function getPublicationReclam()
        {
          $.ajax({
            url: "{{url('/data/message/list/')}}",
            async: 'true',
            type: 'GET',
            dataType: 'json',

            success: function (respuesta) {
                $("#listMessage").html("");
              $.each( respuesta, function( key, value ) 
              {
              //debugger;
                cardData = 
                  "<div class='col s12 m8 offset-m2 l6'>"+
                    "<div class='card-panel z-depth-1 report-size'>"+
                      "<div class='row'>"+
                        "<div class='col s12'>"+
                          "<span class='black-text'>"+
                          "<b>"+
                            "Publicación que realizó "+ value.name +
                            "</b>"+
                          "</span>"+
                          "<br>"+
                          "<span class='black-text'>"+
                          "<a href='/publication-list/"+value.idPublicacion+"'>"+
                              value.tituloPublicacion+
                              "</a>"+
                          "</span>              "+
                          "<br><br>"+
                          "<span class='black-text'>"+
                          "<b>"+
                            "Usuario que reclama el objeto "+ 
                            "</b>"+
                          "</span>"+
                          "<br>"+
                          "<span class='black-text'>"+
                            "<a href='/profile/"+value.idUsuarioReclamador+"'> "+value.nombreReclamador+"</a>"+
                          "</span>              "+
                          "<br><br>"+
                          "<span class='black-text'>"+
                          "<b>"+
                            "Mensaje de "+ value.nombreReclamador +
                            "</b>"+
                          "</span>"+
                          "<br>"+
                          "<span class='black-text'>"+
                            value.mensaje+
                          "</span>"+
                          "<br>"+
                        "</div>"+
                        "<p class='row'>"+
                          "&nbsp;"+
                        "</p>"+
                      "</div>"+
                      "<div class='col s12 row'>";
                          if(value.idUsuarioReclamador == {{Auth::user()->id}})
                          {
                              cardReclamo = 
                                "<span class='black-text col s4 center'>"+
                                  "<a href='#modPuntuacion' class='modal-trigger' user='"+value.name+"' objeto='"+value.tituloPublicacion+"' idUsuario='"+value.idUsuario+"' idPublicacion='"+value.idPublicacion+"'>Recuperado</a>"+
                                "</span>";
                              cardData += cardReclamo;
                          }
                          
                          cardData += 
                            "<span class='black-text col s4 center'>"+
                              "<a href='/publication/"+value.idPublicacion+"'>Publicacion</a>"+
                            "</span>";
                          
                          cardData += 
                            "<span class='black-text col s4 center'>"+
                              "<a href='/reclam/delete?id="+value.idPublicacionReclamada+"&idPublicacion="+value.idPublicacion+"'>Borrar</a>"+
                            "</span>";
                          if(value.idUsuario == {{Auth::user()->id}})
                          {
                            cardPublicador = 
                            "<span class='black-text col s4 center'>"+
                              "<a href='/reclam/delete?id="+value.idPublicacionReclamada+"&idPublicacion="+value.idPublicacion+"'>Descartar</a>"+
                            "</span>";
                            //cardData += cardPublicador;
                          }
                        cardData2 = "</div>"+
                        "<br>"+
                    "</div>"+
                  "</div>";
                  cardData += cardData2;
                $("#listMessage").append(cardData);

                
              });
                $(".modal-trigger").on('click', function(){
                  $("#recUsuario").html($(this).attr('user'));
                  $("#recObjeto").html($(this).attr('objeto'));
                  $("#txtIdPublicacion").val($(this).attr('idPublicacion'));
                  $("#txtIdUsuario").val($(this).attr('idUsuario'));
                  $("#modPuntuacion").modal('open');
                });
            
            },
            error: function (x, h, r) {
                alert("Error: " + x + h + r);

            }

            });
          }
    });
    </script>
@stop