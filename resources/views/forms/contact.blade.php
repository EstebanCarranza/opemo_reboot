@extends('layouts.master')
@section('content')
<br>
 <div class="row">

    <form class="card col s10 offset-s1" method="post" action="/send-contact">
      <br>
          <div class="row">
            <h5 class="center-align">Formulario de contacto</h5>
        </div>
      <div class="input-field col l4 m6 s12">
        <input id="txtNombre" type="text" class="validate">
        <label class="active" for="txtNombre">Tu nombre</label>
      </div>
      <div class="input-field col l4 m6 s12">
        <input id="txtApellido" type="text" class="validate">
        <label for="txtApellido">Tu apellido</label>
      </div>
     
        <div class="input-field col l4 m12 s12">
          <input id="email" type="email" class="validate">
          <label for="email">Tu correo</label>
        </div>
   
     <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea" data-length="120"></textarea>
          <label for="textarea1">Tu pregunta</label>
        </div>
       <div class="row">
       <div class="col s12 row">
       <button class="col s12 btn waves-effect waves-light orange" type="submit" name="action">
       Enviar información
        </button>
        </div>
        </div>
    </form>
</div>
<script>
 $(document).ready(function() {
    $('textarea#textarea1').characterCounter();
  });
</script>
@stop