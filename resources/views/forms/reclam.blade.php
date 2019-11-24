@extends('layouts.master')
@section('content')

<form method="post" action="/send-reclam">
  <ul class="collapsible expandable">
  <li class="row">
    <h1 class="flow-text col s12 center"> Responde las siguientes preguntas creadas por 'usuario' para 'mochila perdida'</h1>
  </li>
    <li class="row">
      <div class="collapsible-header col s12"><i class="material-icons">question_answer</i>¿Qué cosas tenía dentro la mochila perdida?</div>
      <div class="collapsible-body col s12 row">
        <div class="col input-field col s12">
            <input id="answer1" type="text" class="validate input-answer" asw="false">
            <label for="answer1">Tu respuesta</label>
        </div>
      </div>
    </li>
    <li>
      <div class="collapsible-header cols s12"><i class="material-icons">question_answer</i>¿Cómo determina que es su mochila y no de alguien más?</div>
      <div class="collapsible-body col s12 row">
        <div class="col input-field s12">
            <input id="answer2" type="text" class="validate input-answer" asw="false">
            <label for="answer2">Tu respuesta</label>
        </div>
      </div>
    </li>
    <li>
      <div class="collapsible-header cols s12"><i class="material-icons">question_answer</i>Describa otros detalles de la mochila</div>
      <div class="collapsible-body col s12 row">
        <div class="col input-field s12">
            <input id="answer3" type="text" class="validate input-answer" asw="false">
            <label for="answer3">Tu respuesta</label>
        </div>
      </div>
    </li>
    <li>
    <br>
      <div class="row">
       <button class="btn-answer col s10 offset-s1 btn waves-effect waves-light disabled orange" type="submit" name="action">Enviar respuestas
            <i class="material-icons right">send</i>
        </button>
      </div>
      <br>
    </li>
  </ul>
</form>
<script>
    $(document).ready(function(){
    $('.collapsible').collapsible({accordion: false});
    var answer = 0;
    $('.input-answer').keyup(function() 
    {
       
        if($(this).val().length > 0 && $(this).attr('asw') === "false")
        {   
             $(this).attr('asw', "true");
            answer++;
            if(answer==3)
            {
                $(".btn-answer").removeClass("disabled");
            }
        }
        else if($(this).val().length == 0 && $(this).attr('asw') === "true")
        {
             $(this).attr('asw', "false");
            answer--;
            if(answer==2)
            {
                $(".btn-answer").addClass("disabled");
            }
        }
        
    });
  });
</script>
@stop
