<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/syles.css') }}">
</head>
<body>

<div class="login-contenedor">
    <h2>Iniciar Sesion</h2>

    <form>
       <input type="text" placeholder="Usuario" required>
       <input type="password" placeholder="Contraseña" required>

       <a href="{{ url('/menu') }}">Entrar</a>

       <p>No cuento con una cuenta</p>
       <span class="registro">Registrarme</span>
    </form>
</div>

</body>
</html>

