@extends('layouts.master')
@section('content')
<h4 class="center">Reportes de publicaciones</h4>

 <div id="listPR"></div>
        


<script>
  $(document).ready(function()
  {
    getReports();
    function getReports()
    {
      $.ajax({
        url: "{{url('/data/reports/list/')}}",
        async: 'true',
        type: 'GET',
        dataType: 'json',

        success: function (respuesta) {
            
          $.each( respuesta, function( key, value ) 
          {
          
            cardData = 
            "<div class='col s12 m8 offset-m2 l6'>"+
              "<div class='card-panel z-depth-1 report-size'>"+
                "<div class='row'>"+
                  "<div class='col s12'>"+
                    "<span class='black-text'><b>Título de la publicación</b></span>"+
                    "<br>"+
                    "<span class='black-text'>"+value.tituloPublicacion+"</span>"+
                    "<br><br>"+
                    "<span class='black-text'><b>Razón del reporte</b></span>"+
                    "<br>"+
                    "<span class='black-text'>"+value.tituloRazonReporte+"</span>"+
                  "</div>"+
                  "<p class='row'>&nbsp;</p>"+
                "</div>"+
                "<div class='col s12 row'>"+
                    "<span class='black-text col s4 center'>"+
                      "<a href='/profile/"+value.id+"'>Perfil</a>"+
                    "</span>"+
                    "<span class='black-text col s4 center'>"+
                      "<a href='/publication-list/"+value.idPublicacion+"'>Publicación</a>"+
                    "</span>"+
                    "<span class='black-text col s4 center'>"+
                      "<a href='/bloquear/publicacion?id="+value.idPublicacion+"'>Bloquear</a>"+
                    "</span>"+
                  "</div>"+
                  "<br>"+
                "</div>"+
              "</div>" 
            ;
            $("#listPR").append(cardData);
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