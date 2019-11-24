<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Inicio de sesión OPEMO</title>
</head>
<body>
    <p>Hemos detectado que acabas de iniciar sesión desde <a href="http://opemo.twicky.com.mx">OPEMO</a></p>
    ¿No eres tu?, inicia sesión y cambia tu contraseña, aqui te proporcionamos tus datos de usuario
    <ul>
        <li>Nombre:  {{$usuario->name}} </li>
        <li>Correo:  {{$usuario->email}} </li>
    </ul>
</body>
</html>