<!-- Remember: add jquery 2.1.1 + materialize js and materialize css of libraries -->
<?php 
  $data = "https://twicky.app";
  $navbarValue = [
    '0' => "Publicaciones",
    '1' => "Ubicaciones",
    '2' => "Preguntas frecuentes",
    '3' => "Contacto"
  ];
  $navbarRoute =
  [
    '0' => '/publication-list',
    '1' => '/ubications',
    '2' => '/frequent-questions',
    '3' => '/contact'
  ];
?>  

  <div class="navbar-fixed">
<nav class="orange">
    <div class="nav-wrapper container">
      <a id="navMobile" href="#" data-target="mobile-demo" class="sidenav-trigger">
        <i class="material-icons">menu</i>
      </a>
      
       @if(!Auth::guest())
        <a id="navLogo" href="/dashboard" class="brand-logo">
          OPEMO
        </a>
      @else
        <a id="navLogo" href="/" class="brand-logo">
          OPEMO
        </a>
      @endif
     <form id="frmSearch" action="/results">
        <div class="input-field">
          <input name="titulo" id="search" type="search" required placeholder="Escribe lo que quieres buscar y presiona enter">
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i id="srcClose" class="material-icons" title="Cerrar barra de búsqueda">close</i>
        </div>
      </form>
     <div class="row"> 
       <ul id="ulNavBar" class="right hide-on-med-and-down">
      @for($i = 0; $i < count($navbarValue); $i++)
        <li title={{$navbarValue[$i]}}><a class='nav-link link-color' href={{$navbarRoute[$i]}}>{{$navbarValue[$i]}}</a></li>
      @endfor
      <li title="Buscar"><a id="btnSearch"><i class="material-icons">search</i></a></li>
      <li title="Mi cuenta">
        <a id="btnUserLog" class="">
          @if(!Auth::guest())
            <img src="{{url('/image/profile/avatar?id='.Auth::user()->id)}}" class="sidenav-trigger nav-img-profile" data-target="slide-out">
          @else
            <img src="{{url('defaultData/avatar_png.png')}}" class="sidenav-trigger nav-img-profile" data-target="slide-out">
          @endif
        </a>
      </li>

      </ul>
     
        <a id="navMobileProfile" href="#" data-target="slide-out" class="sidenav-trigger right">
          @if(!Auth::guest())  
            <img id="imgProfile" src="{{$UserPhotoProfile}}" class="sidenav-trigger nav-img-profile" data-target="slide-out">
          @else
            <img id="imgProfile" src="{{$UserPhotoProfileDefault}}" class="sidenav-trigger nav-img-profile" data-target="slide-out">
          @endif
        </a>     
    </div>

    
  </nav>
 </div>

  <ul class="sidenav" id="mobile-demo">
  <section class="row ec-search-row">
    <div class="input-field col s10 offset-s1 ec-search-div">
      <form id="frmSearchMobile" action="/results">
        <input name="titulo" id="navBuscarMobile" type="text" class="validate">
        <label for="navBuscarMobile">Buscar...</label>
        <i id="btnSubmitMobile" class="material-icons ec-search-icon">search</i>
      </form>
    </div>
  </section>
    <li><div class="divider"></div></li>
    @for($i = 0; $i < count($navbarValue); $i++)
      <li><a class='nav-link link-color' href={{$navbarRoute[$i]}}>{{$navbarValue[$i]}}</a></li>
    @endfor   
    
  </ul>
<script>   
  $(document).ready(function(){
    $('.sidenav').sidenav();
        $("#frmSearch").hide();
      
    $("#btnSearch").click(function(){
      $("#navLogo").slideToggle( 200 );
        $("#ulNavBar").slideToggle( 200 );
        $("#frmSearch").slideToggle( 200 );
       
    });
    $("#srcClose").click(function()
    {
      $("#navLogo").slideToggle( 200 );
      $("#ulNavBar").slideToggle( 200 );
      $("#frmSearch").slideToggle( 200 );
      
    });
   
    $("#btnSubmitMobile").click(function(){
      $( "#frmSearchMobile" ).submit();
    });

  });
  </script>
  