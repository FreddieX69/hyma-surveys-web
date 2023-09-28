<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <style>
        /* Estilos para el cuerpo del correo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        /* Estilos para el contenedor principal */
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para el logo */
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Estilos para el enlace de recuperación de contraseña */
        .reset-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="{{ public_path('/assets/images/logo/logo-hyma-completo.png') }}" alt="Logo de la empresa" width="100">
    </div>
    <h2>Recuperación de Contraseña</h2>
    <p>Hemos recibido una solicitud para restablecer tu contraseña. Haz clic en el enlace de abajo para continuar con el proceso:</p>
    <a href="{{ $link }}" class="reset-link">Restablecer Contraseña</a>
    <p>Si no solicitaste restablecer tu contraseña, puedes ignorar este mensaje.</p>
</div>
</body>
</html>
