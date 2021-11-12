<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
    </head>

    <body>
        <p>Hola <b>{{$name}}</b>, se solicitó <b>Restablecer tu contraseña</b> para tu cuenta, en <b>"Mensajería ITTG"</b>.</p>
        <p>Para continuar con la solicitud haz click en el siguiente enlace:</p>
        <a href="{{url('/resetPassword/'.$email.'')}}">
            Clic para recuperar contraseña
        </a>
        <p><small>Si esta solicitud no fue hecha por ti, no necesita realizar ninguna acción.</small></p>
        
    </body>

</html>