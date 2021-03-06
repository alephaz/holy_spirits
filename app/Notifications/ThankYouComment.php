<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ThankYouComment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (app()->getLocale() === 'en') {
            return (new MailMessage)
                ->subject('Thank you for sending us your Comments')
                ->line('Thank you for sending us your comment or question.  We read every email that we receive, and it is our desire to respond to as many as possible.')
                ->line('Thank you for loving us and supporting us as we continue to go into all the world to share the good news of Jesus.')
                ->line('We pray for the Lord to be glorified in and through your life!')
                ->line('You are loved,')
                ->line('Andres and Giannina Bisonni')
                ->line('www.HolySpirit.tv')
                ->line('"May the God of hope fill you with all joy and peace in believing, that you may abound in hope by the power of the Holy Spirit."  Romans 15:13');
        }

        if (app()->getLocale() === 'es') {
            return (new MailMessage)
                ->subject('Gracias por enviarnos su comentario')
                ->line('Gracias por enviarnos su comentario o pregunta.  Leemos todos los correos que recibimos, y es nuestro deseo el responder la mayor cantidad posible.')
                ->line('Gracias por amarnos y por apoyarnos para que podamos seguir compartiendo el evangelio de Jes??s alrededor del mundo.')
                ->line('Oramos para que el Se??or sea glorificado por medio de tu vida!')
                ->line('Eres amado,')
                ->line('Andres y Giannina Bisonni')
                ->line('www.EspirituSanto.com')
                ->line('Y el Dios de esperanza os llene de todo gozo y paz en el creer, para que abund??is en esperanza por el poder del Esp??ritu Santo.  (Romanos 15:13)');
        }
        
        if (app()->getLocale() === 'iw') {
            return (new MailMessage)
                ->subject('???????? ?????????? ?????????? ???? ????????????')
                ->line('???????? ?????????? ?????????? ???? ?????????? ???? ??????????. ?????? ???????????? ???? ??????"?? ???????? ????????????, ?????????????? ?????????? ???????? ??????????.')
                ->line('?????? ???? ?????????? ???? ???? ?????????? ?????????? ?????????? ?????? ???????? ???????????? ?????????????? ???????? ?????? ?????????? ?????????? ???? ???????????? ?????????? ???? ????????.')
                ->line('?????? ?????????????? ???????????? ?????????? ????????????!')
                ->line('?????? ????????,')
                ->line('?????????? ???????????????? ????????????')
                ->line('www.HolySpirit.tv')
                ->line('"?????????? ?????????? ???????? ???????? ???? ???????? ?????????? ????????????????, ?????? ?????????? ?????? ?????????? ?????? ?????? ????????." ???? ???????????? ???? 13');
        }
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
            //
        ];
    }
}
