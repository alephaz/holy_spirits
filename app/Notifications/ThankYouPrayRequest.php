<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ThankYouPrayRequest extends Notification
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
                ->subject('We are praying for your request')
                ->line('Thank you for sending us your prayer request.  We will be praying for the Lord to supply all your needs and to give you the desires of your heart.')
                ->line('Have the assurance that for our God there is nothing impossible, and that our Father loves to give good gifts to His children.')
                ->line('Thank you for loving us and supporting us as we continue to go into all the world to share the good news of Jesus.')
                ->line('We pray for the Lord to be glorified in and through your life!')
                ->line('You are loved,')
                ->line('Andres and Giannina Bisonni')
                ->line('www.HolySpirit.tv')
                ->line('"Ask, and you will receive, that your joy may be full." Jesus (John 16:24)');
        }

        if (app()->getLocale() === 'es') {
            return (new MailMessage)
                ->subject('Estamos orando por tu petición')
                ->line('Gracias por enviarnos tu petición de oración.  Vamos a estar orando para que el Señor supla todas tus necesidades conceda los deseos de tu corazón. ')
                ->line('Ten la certeza de que para Dios no hay nada imposible, y que a nuestro Padre le agrada dar buenos regalos a sus hijos.')
                ->line('Gracias por amarnos y por apoyarnos para que podamos seguir compartiendo el evangelio de Jesús alrededor del mundo.')
                ->line('Oramos para que el Señor sea glorificado por medio de tu vida!')
                ->line('Eres amado,')
                ->line('Andres y Giannina Bisonni')
                ->line('www.EspirituSanto.com')
                ->line('"Pedid, y recibiréis, para que vuestro gozo sea cumplido.”  Jesús  (Juan 16:24)');
        }
        
        if (app()->getLocale() === 'iw') {
            return (new MailMessage)
                ->subject('אנו מתפללים על בקשת תפילתך')
                ->line('תודה ששלחת אלינו את בקשת התפילה שלך. אנו נתפלל שהאדון יספק את כל צרכיך וייתן לך את משאלות ליבך.')
                ->line('זכור בביטחון שדבר אינו מחוץ להישג ידו של האדון, ושהוא אוהב ונותן דברים טובים לילדיו')
                ->line('תודה שאהבת אותנו ותומכת בנו בזמן שאנחנו ממשיכים ללכת לכל העולם לחלוק את הבשורה הטובה של ישוע.')
                ->line('אנו מתפללים שהאדון יתפאר בחייכם ודרככם!')
                ->line('אתה אהוב,')
                ->line('Andres and Giannina Bisonni')
                ->line('www.HolySpirit.tv')
                ->line('"שאל, ותקבל, כי שמחתך תהיה מלאה" יוחנן טז 24');
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
