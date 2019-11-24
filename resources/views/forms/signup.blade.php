<!--<input type="hidden" name="login" value=true>
    <input type="hidden" name="action" value="signup">
    action="/dashboard"
    -->
<form id="frmSignUp" class="" method="POST" action="{{route('register')}}">
   {{csrf_field()}}
    <input type="hidden" name="type" value="register">
    <li class="row">
        <h5 class="center"> Registrarme </h5>
        <div id="SiUp_errorData" class="input-field col s10 offset-s1">
            <strong><h6  class="red-text center">Ya existe este usuario intenta con otro correo</h6></strong>
        </div>
        <div id="SiUp_errorPassword" class="col s10 offset-s1">
            <strong><h6 class="red-text center">La contraseña debe tener mínimo 6 caracteres</h6></strong>
        </div>
        <div class="input-field col s10 offset-s1">
        <input name="name" id="logSNombre" type="text" class="validate" required>
        <label for="logSNombre">Nombre</label>
        </div>
        <div class="input-field col s10 offset-s1">
        <input name="email" id="logSCorreo" type="email" class="validate" required>
        <label for="logSCorreo">Correo electrónico</label>
        </div>
        
        <div class="input-field col s10 offset-s1">
        <input name="password" id="logSContrasenia" type="password" class="validate" required>
        <label for="logSContrasenia">Contraseña <small>(mínimo 6 caracteres)</small></label>
        </div>
        <div class="input-field col s10 offset-s1">
        <input name="password_confirmation" id="logSRepetirContrasenia" type="password" class="validate" required>
        <label for="logSRepetirContrasenia">Repetir contraseña</label>
        </div>
        
    </li>
    <li class="row">
    
        <div class="input-field col s10 offset-s1 row">
        <button id="btnSignUp" class="disabled btn waves-effect waves-light col s12 orange" type="submit" name="action">
           Siguiente
            <i class="material-icons right">send</i>
        </button>
        </div>
    </li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">¿Ya estás registrado?</a></li>
    <li><a href="#!" id="lnkIniciarSesion">Iniciar sesión</a></li>
</form>

<script>
    $(document).ready(function()
    {
        $("#SiUp_errorData").hide();
        $("#SiUp_errorPassword").hide();
        
        /*
        $("#frmSignUp").on('submit', function(evt){
            evt.preventDefault();  
            // tu codigo aqui
            if
            (
                $("#logSNombre").val() != "" 
                && $("#logSCorreo").val() != ""
                && $("#logSContrasenia").val() != ""
                && $("#logSRepetirContrasenia").val()!=""
            )
            {
                if($("#logSContrasenia").val() == $("#logSRepetirContrasenia").val())
                {
                    $("#frmSignUp").submit();
                }
                else 
                 alert('las contraseñas no son iguales');
            }else 
            {
                alert('hay campos vacíos');
            }
            
        });
        */

        function SiUp_validar_campos_vacios()
        {   
            if($("#logSNombre").val() != "" 
            && $("#logSCorreo").val() != ""
            && $("#logSContrasenia").val() != ""
            && $("#logSRepetirContrasenia").val()!=""
            )
            {
                if($("#logSContrasenia").val() == $("#logSRepetirContrasenia").val())
                {
                    if($("#logSContrasenia").val().length >= 6)
                        $("#btnSignUp").removeClass("disabled");
                    else
                        $("#btnSignUp").addClass("disabled");
                }   
                else
                        $("#btnSignUp").addClass("disabled");
                
            }else
            {
                $("#btnSignUp").addClass("disabled");
            }
        }

        $("#logSNombre").keyup(function(){
            SiUp_validar_campos_vacios();
        });
        $("#logSCorreo").keyup(function(){
            SiUp_validar_campos_vacios();
        });
        $("#logSContrasenia").keyup(function(){
            SiUp_validar_campos_vacios();
        });
        $("#logSRepetirContrasenia").keyup(function(){
            SiUp_validar_campos_vacios();
        });


    });
</script>