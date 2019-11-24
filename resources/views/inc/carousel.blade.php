
<style>

  .inner-shadow-background:
    {
       -webkit-box-shadow: inset 0px 0px 500px 72px rgba(0,0,0,1);
      -moz-box-shadow:    inset 0px 0px 500px 72px rgba(0,0,0,1);
      box-shadow:         inset 0px 0px 500px 72px rgba(0,0,0,1);
    }
    .ec-cover-style
    {
      position:absolute; width:100%; padding:0%;
    }
    .ec-cover-effects
    {
      width:100%;
      background-color:green;
      z-index:10;
      position:absolute;
    }
    .cover-image-container
    {
      -webkit-box-shadow: inset 0px 0px 500px 72px rgba(0,0,0,1);
      -moz-box-shadow:    inset 0px 0px 500px 72px rgba(0,0,0,1);
      box-shadow:         inset 0px 0px 500px 72px rgba(0,0,0,1);
      background-color:none;
      width:100%;
    }
    .cover-image
    {
      
      opacity: 0.8;
      filter: alpha(opacity=80);
      width:100%;
      object-fit: cover;
      height:600px;
       /*height: 600px;*/
      
    }
    .cover-text 
    {
      z-index:1;
        text-shadow:0px 0px 5px #454545;, -1px 0 #454545, 1px 0 #454545, 0 1px #454545, 0 -1px #454545;
    }
    .carousel
    {
      margin-top: 0%;
      margin-bottom: 1%;
      max-height:100%;
    }
    .carousel-arrows
    {
      z-index:2;
      position:absolute;
      height:100%;
      display: flex; 
      justify-content: center; 
      align-items: center;
      width:20%;
      color:white;
      font-size:64px;
      cursor:pointer;
      
    }
    .carousel-arrows:hover
    {
      background-color:rgba(0,0,0,0.1);
    }
    .ec-carousel-left 
    {
      left:0px;
    }
    .ec-carousel-right
    {
      right:0px;
    }
   
</style>

<div class="carousel carousel-slider center " style="">
<div class="carousel-arrows ec-carousel-left">
 <h1 class="material-icons center-align"> chevron_left</h1>
</div>
<div class="carousel-arrows ec-carousel-right">
 <h1 class="material-icons center-align"> chevron_right</h1>
</div>

    <div class="carousel-item orange white-text center" href="#one!">
      <div class="cover-image-container">
        <img class="cover-image" src="img/catbox.jpg">
      </div>
      <div class="carousel-fixed-item center">
        <h1 class="" style="text-shadow: 3px 3px 2px #454545;">
          ¡Bienvenido a OPEMO!
        </h1>
        <h4 class="" style="text-shadow: 3px 3px 2px #454545;">
          Objetos Perdidos Monterrey :D
        </h4>
      </div>
    </div>
    <div class="carousel-item blue darken-1 white-text" href="#two!">
      <div class="cover-image-container">
        <img class="cover-image" src="img/welcome-kit-contents.jpg">
      </div>
      <div class="carousel-fixed-item center">
        <h1 class="" style="text-shadow: 3px 3px 2px #454545;">
          ¡Podrás buscar cualquier cosa!
        </h1>
        <h4 class="" style="text-shadow: 3px 3px 2px #454545;">
          Cualquier cosa que hayas extraviado en el área metropolitana de Monterrey
        </h4>
      </div>
    </div>
    <div class="carousel-item blue darken-4 white-text" href="#three!">
      <div class="cover-image-container">
        <img class="cover-image" src="img/getty.jpg">
      </div>
      <div class="carousel-fixed-item center">
        <h1 class="" style="text-shadow: 3px 3px 2px #454545;">
          Ten mejores momentos sin preocupaciones
        </h1>
        <h4 class="" style="text-shadow: 3px 3px 2px #454545;">
          Disfruta tus vacaciones y del tiempo con tus seres queridos
        </h4>
      </div>
    </div>
  </div>
  <script>
  

  // Or with jQuery

  $(document).ready(function(){
    /*$('.carousel').carousel(
      {
        fullWidth: true,
    indicators: true,
    duration:200
      }
    );*/
    
     $('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true
  });

    var carVel = 6;
    function mover_carousel()
    {
      $('.carousel').carousel('next');
    }
    setInterval(mover_carousel, carVel*1000);

    $(".ec-carousel-left").click(function()
    {
      $('.carousel').carousel('prev');
    });
    
    $(".ec-carousel-right").click(function()
    {
      $('.carousel').carousel('next');
    });

  });
      
  </script>
