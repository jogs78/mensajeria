<?php

namespace App\Notifications;

use App\Models\Mensaje;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;

class MensajeNotification extends Notification implements ShouldBroadcast

{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mensaje $mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable):array
    {
      
        return ['broadcast', 'database'];
    }
    
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            
            'titulo' => $this->mensaje->titulo,
            'descripcion' => $this->mensaje->descripcion,
            'imagen' => $this->mensaje->imagen,
            'documento' => $this->mensaje->documento,
            'emisor' => $this->mensaje->empleado_id,
            'carreras' => $this->mensaje->carreras,
            'semestres' => $this->mensaje->semestres,
        ];
    }
    public function toBroadcast($notifiable): BroadcastMessage
    {
        // foreach( Alumno::getMensaje($event->mensaje) as $alumno){
        //     Notification::send($alumno, new MensajeNotification($event->mensaje));
        // }
        return new BroadcastMessage([
            'message' => "$this->mensaje (User $notifiable->id)"
        ]);
    }
}
