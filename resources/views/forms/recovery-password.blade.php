<form action="/dashboard" class="">
    <input type="hidden" name="login" value=true>
    <input type="hidden" name="action" value="recovery">
    <li class="row">
        <h5 class="center"> Recuperar contraseña </h5>
        <div class="input-field col s10 offset-s1">
        <input id="logCorreoRecuperacion" type="email" class="validate" required>
        <label for="logCorreoRecuperacion">Correo electrónico</label>
        </div>
        <div class="input-field col s10 offset-s1 row">
        <button class="btn waves-effect waves-light col s12 orange" type="submit" name="action">
            Siguiente
            <i class="material-icons right">send</i>
        </button>
        </div>
    </li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">¿Ya estás registrado?</a></li>
    <li><a href="#!" class="lnkIniciarSesion">Iniciar sesión</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">¿No tienes cuenta?</a></li>
    <li><a href="#" class="lnkRegistrar">Registrate</a></li>
</form>