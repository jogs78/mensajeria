<!DOCTYPE html>

<head>
    <meta name="user-id" content="{{ Auth::user()->id }}">
    <title>Pusher Test</title>
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Publish an event to channel <code>my-channel</code> with event name <code>my-event</code>; it will appear below:
    </p>
    

    {{-- <script src="https://unpkg.com/vue@next"></script> --}}
    <script src="{{asset('/js/app.js')}}"></script>
    <script>
        // var userId = $('meta[name="userId"]').attr('content');
        let id = document.querySelector("meta[name='user-id']").getAttribute('content');
        console.log(id)
    //     window.Echo.channel('events')
    // .listen('MensajeEvent', (e) => {
    //     console.log(e);
    // });
        Echo.private('App.Models.Alumno.'+id)
        .notification((notification) => {
            console.log(notification);
        });
    </script>
</body>