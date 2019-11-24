<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <input type="hidden" name="login" value=true>
    <input type="hidden" name="action" value="login">
     <input type="hidden" name="type" value="login">
    <li class="row">
        <h5 class="center"> Iniciar sesión </h5>
        <div id="SiUp_errorDataLogin" class="input-field col s10 offset-s1">
            <strong><h6  class="red-text center">Contraseña incorrecta</h6></strong>
        </div>
        <div class="input-field col s10 offset-s1">
            <input name="email" id="logCorreo" type="email" class="validate" required>
            <label for="logCorreo">Correo electrónico</label>
        </div>
        <div class="input-field col s10 offset-s1">
            <input name="password" id="logContrasenia" type="password" class="validate" required>
            <label for="logContrasenia">Contraseña</label>
        </div>
        <div class="input-field col s10 offset-s1 row">
        <button id="logButton" class="btn waves-effect waves-light col s12 orange" type="submit" name="action">
            Siguiente
            <i class="material-icons right">send</i>
        </button>
        </div>
    </li>
    <li><div class="divider"></div></li>
    <!--<li><a class="subheader">¿Olividaste tu contraseña?</a></li>
    <li><a href="#!" id="lnkRecuperarContrasenia">Recuperar contraseña</a></li>-->
    <li><div class="divider"></div></li>
    <li><a class="subheader">¿No tienes cuenta?</a></li>
    <li><a href="#" id="lnkRegistrar">Registrate</a></li>
</form>
<script>
    $(document).ready(function(){
        $("#logButton").addClass("disabled");
        $('#SiUp_errorDataLogin').hide();
       $("#logContrasenia").keyup(function()
       {
           if($(this).val().length >= 6)    $("#logButton").removeClass("disabled");
           else $("#logButton").addClass("disabled");
           
       });
    });
</script>