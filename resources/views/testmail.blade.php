<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
    </head>

    <body>
        <h2>Hola {{$name}} bienvenido a mensajeria ITTG</h2>
        <p>Por favor confirma tu correo electronico.</p>
        <p>Para ello has click en el siguiente enlace:</p>
        <a href="{{url('register/verify'.$confirmation_code)}}">
            Clic para confirmar correo electronico.
        </a>
    </body>

</html>