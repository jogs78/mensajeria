<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar contraseña</title>
</head>

<body>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .header-container {
            height: 80px;
            background: #0d47a1;
        }

        .recuperar-contraseña {
            width: 90vw;
            height: 100vh;
            position: relative;
            margin: auto;
            top: -10px;
        }

        .recuperar-contraseña__contianer {
            background: rgb(255, 255, 255);
            border-radius:0 0 10px 10px;
            box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px;
        }
        .recuperar-contraseña__contianer h2 {
            background: rgb(0, 0, 0);
            padding: 3px;
            font-size: 1.5rem;
            text-shadow: -1px 1px 0px #00e6e6,
                -4px 4px 0px #49a1a1;
            font-family: 'Ubuntu', sans-serif;
            font-weight: bold;
            color: #121212;
            text-align: center;
            letter-spacing: 5px;
            text-shadow: -1px 1px 0 #41ba45,
                1px 1px 0 #c63d2b,
                1px -1px 0 #42afac,
                -1px -1px 0 #c6c23f;

        }
        .recuperar-contraseña__contianer small{
            padding: 8px;
            text-decoration: underline;
        }
        .form-reset {
            padding: 5px;
            margin: auto;
            background: white;
            width: 250px;
        }

        .form-reset input {
            padding: 2px;
            margin: 5px
        }
        .btn {
            background: #0d47a1;
            color: rgb(255, 255, 255);
            padding: 5px;
            width: 70%;
            margin: auto;
            border: 0;
            border-radius: 8px;
            transition: transform .5s ease;
        }

        .btn:active {
            transform: scale(.9)
        }
    </style>
    <header>
        <div class="header-container">
        </div>
    </header>
    <section class="recuperar-contraseña">
        <div class="recuperar-contraseña__contianer">
            <h2>Hola {{ $user->nombre }}, bienvenido </h2>
            <small><b>Mí correo electrónico: {{ $user->correo }}</b></small>
            <form action="/resetPassword" method="POST" class="form-reset">
                @csrf
                <input type="hidden" value="{{$user->correo}}" name="correo">
                <input type="password" placeholder="Contraseña nueva" name="p1">
                <input type="password" placeholder="Confirmar contraseña" name="p2">
                <button class="btn">Guardar</button>
            </form>
        </div>
    </section>
</body>

</html>
