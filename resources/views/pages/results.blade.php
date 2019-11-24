@extends('layouts.cards')
@section('body')
<div class="col s12 card-panel">
<div class="input-field col l4 m6 s12">
        <input id="pubTitulo" type="text" class="validate" required value="">
        <label for="pubTitulo">Titulo</label>
    </div>
     <div class="input-field col l4 m6 s12">
                <input id="pubFecha" type="text" class="validate datepicker" name="fecha" required>
                <label for="pubFecha">Fecha</label>
            </div>
            <div class="input-field col l4 m6 s12">
                <input id="pubHora" type="text" name="hora" class="validate timepicker" required>
                <label for="pubHora">Hora</label>
            </div>

             <div class="input-field col l4 m6 s12">
                <input id="pubUbicacion" type="text" class="validate" required>
                <label for="pubUbicacion">Ubicación</label>
            </div>
            <div class="input-field col l4 m6 s12">
               <input id="pubMunicipio" type="text" class="validate" required>
                <label for="pubMunicipio">Municipio</label>
            </div>
    <div class="input-field col l2 m4 s12">
        <a id="btnBuscar" class="col s12 waves-effect waves-light btn orange">Buscar</a>
    </div>
    <div class="input-field col l2 m4 s12">
        <a id="btnLimpiar" class="col s12 waves-effect waves-light btn orange">Limpiar</a>
    </div>
</div>
<div id="search-results">
   
</div>

    <script>
    $(document).ready(function()
    {
         $('.datepicker').datepicker({
        autoClose : true,
        format : 'yyyy-mm-dd'
    });
    $('.timepicker').timepicker({
        twelveHour : false
    });
    $('select').formSelect();
    $("#btnBuscar").click(function()
    {
       // alert("");
        getResultados();
    });
    //getResultados();
    function getCargando()
    {
        $("#search-results").html(
        "<p>&nbsp;</p><div class='center'>"+
            "<div class='preloader-wrapper big active'>"+
                "<div class='spinner-layer spinner-green-only'>"+
                    "<div class='circle-clipper left'><div class='circle'></div></div>"+
                    "<div class='gap-patch'><div class='circle'></div></div>"+
                    "<div class='circle-clipper right'><div class='circle'></div></div>"+
                "</div>"+
            "</div>"+
        "</div>");
    }
     
    var dataToSend = {};
    var pagination = 1;
    var lastPage = 0;
    var previousPage = 0;
    var nextPage = 2;
        $(".page").click(function(){
            pagination = $(this).text();
            getResultados();
        });
        
    $("#btnLimpiar").click(function()
    {
        $("#pubTitulo").val("");  
        
        $("#pubFecha").val("");
        
        $("#pubHora").val("");

        $("#pubUbicacion").val("");

        $("#pubMunicipio").val("");
        
        /*$("#cbxUbicacion").val("");
        
        $("#idCiudad").val("");*/
    });
    <?php 
        if(isset($_GET['titulo']))
        {
            echo "$('#pubTitulo').val('".$_GET['titulo']."');";
            echo "getResultados();";
        }
    ?>
        function getResultados()
        {
            getCargando();  
            //debugger;
            dataToSend.page = pagination;
            if($("#pubTitulo").val()!="")
                dataToSend.titulo = $("#pubTitulo").val();  
            if($("#pubFecha").val()!="")
                dataToSend.fecha = $("#pubFecha").val();
            if($("#pubHora").val()!="")
                dataToSend.hora = $("#pubHora").val()+":00";
            if($("#pubUbicacion").val() !="")
                dataToSend.ubicacion =  $("#pubUbicacion").val();
            if($("#pubMunicipio").val()!="")
                dataToSend.municipio = $("#pubMunicipio").val();
   // debugger;
            $.ajax({
                url: "{{url('/search')}}",
                async: 'true',
                data:dataToSend,
                type: 'GET',
                dataType: 'json',

                success: function (respuesta) {
                    //debugger;
                    //debugger;
                $("#search-results").html("");
               // debugger;
                delete dataToSend.titulo;
                delete dataToSend.fecha;
                delete dataToSend.hora;
                delete dataToSend.ubicacion;
                delete dataToSend.municipio;

                if(respuesta.current_page == 0)
                {
                    $("#search-results").html("<h4 class='center orange-text'>No se encontraron resultados <li class='large orange-text material-icons'>sentiment_very_dissatisfied</li></h4>");
                }
                else
                {
                        for(var i = 0; i < respuesta.data.length; i++)
                        {          
                            var link = "";
                            var imagenURL = "";
                            var tituloCiudadCompleto = "";
                            if(respuesta.data[i].tipoResultado == "publicacion")
                            {
                                link = "/publication-list/" + respuesta.data[i].idPublicacion;
                                imagenURL = "/image/publication?mode=1&id=" + respuesta.data[i].idPublicacion;
                            }
                            else if(respuesta.data[i].tipoResultado == "ubicacion")
                            {
                                link = "/ubications/" + respuesta.data[i].idPublicacion;
                                imagenURL = "/image/ubication?id=" + respuesta.data[i].idPublicacion;
                            }
                            else if(respuesta.data[i].tipoResultado =="usuario")
                            {
                                link = "/profile/" + respuesta.data[i].idPublicacion;
                                imagenURL = "/image/profile/cover?id=" + respuesta.data[i].idPublicacion;
                            }
                            (respuesta.data[i].tituloCiudadCompleto!=null)?tituloCiudadCompleto=respuesta.data[i].tituloCiudadCompleto:tituloCiudadCompleto='';
                            var card =  
                                "<div class='col l4 m6 s12 animated-card card-row-custom-size'>" +
                                    "<div class='card small hoverable card-custom-size'>" +
                                        "<div class='card-image waves-effect waves-block waves-light'>" +
                                            "<img class='activator' src='"+imagenURL+"'>" +
                                        "</div>" +
                                        "<div class='card-content'>" +
                                            "<a href='#' class=''><i class='material-icons right activator'>more_vert</i></a>" +
                                            "<span class='card-title  grey-text text-darken-4 truncate'>"+respuesta.data[i].tituloPublicacion+"</span>" +                                        
                                            "<p><a href='"+link+"'>Abrir</a>"+
                                            "<div class='card-footer'>" +
                                                "<small class='text-muted truncate'>" +
                                                    tituloCiudadCompleto+"&nbsp;<br>" +
                                                    respuesta.data[i].antiguedad +
                                                "</small>" +
                                            "</div>" +
                                        "</div>" +
                                        "<div class='card-reveal'>" +
                                            "<div><i class='material-icons right card-title'>close</i></div>" +
                                            "<span class='card-title grey-text text-darken-4'>"+respuesta.data[i].tituloPublicacion+"</span>" +
                                            "<p class='flow-text'>" +
                                            respuesta.data[i].descripcion+
                                            "</p>  " +
                                            "<div class='card-footer'>" +
                                                "<small class='text-muted truncate'>" +
                                                    respuesta.data[i].tituloCiudadCompleto+"&nbsp;<br>" +
                                                    respuesta.data[i].antiguedad +
                                                "</small>" +
                                            "</div>"+
                                        "</div>"+
                                    "</div>"+
                                "</div>";
                            $("#search-results").append(card);
                        } 
                        $("#page2").show();
                        $("#page3").show();
                        $("#page4").show();
                        $("#pageLast").show();
                        
                        $("#pageLi1").removeClass("active");
                        $("#pageLi2").removeClass("active");
                        $("#pageLi3").removeClass("active");
                        $("#pageLi4").removeClass("active");
                        $("#pageLiLast").removeClass("active");
                        
                        
                        switch(respuesta.current_page)
                        {
                            case 1:
                            {
                                $("#pageLi1").addClass("active");
                                if(respuesta.last_page == 1)
                                {
                                    $("#page2").hide();
                                    $("#page3").hide();
                                    $("#page4").hide();
                                    $("#pagePoints").hide();
                                    $("#pageLast").hide();
                                }
                                
                                break;
                            }
                            case 2:
                            {
                                $("#pageLi2").addClass("active");
                                if(respuesta.last_page == 2)
                                {
                                    $("#page3").hide();
                                    $("#page4").hide();
                                }
                                break;
                            }
                            case 3:
                            {
                                $("#pageLi3").addClass("active");
                                if(respuesta.last_page == 3)
                                {
                                    $("#page4").hide();
                                }
                                break;
                            }
                            case 4:
                            {
                                $("#pageLi4").addClass("active");
                                break;
                            }
                            case respuesta.last_page:
                            {
                                $("#pageLiLast").addClass("active");
                                break;
                            }
                            default:break;
                        }
                        $(".pagination .element").removeClass("orange");
                        $(".pagination .active").addClass("orange");
                        $("#pageLast").text(respuesta.last_page);
                        $("#paginationRow").show();
                    }
                //debugger;
                },
                error: function (x, h, r) {
                    alert("Error: " + x + h + r);

                }

            });
        }
        


    });
    </script>
@stop
@section('pagination')
    @include('inc.pagination')
@stop