<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
    </head>

    <body>
        <p>Hola {{$name}}, se solicitó un reinicio de contraseña para su cuenta, en mensajería ittg.</p>
        <p>Para confirmar esta solicitud, y configurar una nueva contraseña para su cuenta, por favor,
            haga click en el siguiente enlace.
        </p>
        <a href="{{url('log-in')}}">
            Clic para reiniciar contraseña
        </a>
        <p>Si este reinicio de contraseña no fue solicitado por usted, no necesita hacer nada.</p>
        
    </body>

</html>