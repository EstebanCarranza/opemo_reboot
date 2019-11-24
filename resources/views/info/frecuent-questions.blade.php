@extends('layouts.master')

@section('content')
 <ul class="collapsible">
    <li class="row">
      <h1 class="flow-text center col s12"> Preguntas frecuentes </h1>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">question_answer</i>
      ¿Opemo cobra alguna subscripción al usuario?
      </div>
      <div class="collapsible-body"><span>
      No, opemo es una empresa sin fines de lucro y con éste sitio (opemo.herokuapp.com) 
      no busca que el cliente compre algún tipo de subscripción por el servicio.
      </span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">question_answer</i>
      ¿Cómo puedo encontrar algo que perdí?
      </div>
      <div class="collapsible-body"><span>
      Opemo solo muestra cosas perdidas que la comunidad encuentra, si la misma comunidad 
      no publica dicha cosa no podrá ser visualizada en el sitio.
      </span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">question_answer</i>
      ¿Cómo recupero mis cosas?
      </div>
      <div class="collapsible-body"><span>
      Para recuperar sus cosas se le dará la oportunidad al usuario registrado de reclamar el producto, 
        contestando preguntas que la persona en posesión del producto haya decidido,  
        confiamos con fé de que las personas no entregarán el producto a cualquier persona que reclame por él, 
        por la misma razón no cobramos ya que la persona que quiere realizar la acción de regresar debe 
        tener la actitud caritativa de querer regresar dicho producto.
      </span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">question_answer</i>
      ¿La persona en posesión del producto puede poner algún precio dentro de opemo para la recuperación del producto?
      </div>
      <div class="collapsible-body"><span>
        No, en opemo no manejamos ninguna sección donde el usuario pueda capturar el precio por el 
        producto si la persona quiere cobrar por algún producto no será responsabilidad de opemo.
      </span></div>
    </li>
    
  </ul>
<script>
 $(document).ready(function(){
    $('.collapsible').collapsible();
  });
</script>
@stop
