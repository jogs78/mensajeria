<?php

namespace App\Listeners;

use App\Models\Alumno;
use App\Notifications\MensajeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class MensajeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        
        foreach( Alumno::getMensaje($event->mensaje) as $alumno){
            Notification::send($alumno, new MensajeNotification($event->mensaje));
        }
    }
}
