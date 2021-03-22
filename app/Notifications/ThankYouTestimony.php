<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ThankYouTestimony extends Notification
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
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (app()->getLocale() === 'en') {
            return (new MailMessage)
                ->subject('Thank you for sending us your testimony')
                ->line('It is a blessing to hear about what the Lord has done in your life by the power of the Holy Spirit.  We rejoice with you and give God the glory! Thank you for sharing your story with us!')
                ->line('We also thank you for loving us and supporting us as we continue to go into all the world to share the good news of Jesus.')
                ->line('We pray for the Lord to be glorified in and through your life!')
                ->line('You are loved,')
                ->line('Andres and Giannina Bisonni')
                ->line('www.HolySpirit.tv')
                ->line('"May the God of hope fill you with all joy and peace in believing, that you may abound in hope by the power of the Holy Spirit."  Romans 15:13');
        }

        if (app()->getLocale() === 'es') {
            return (new MailMessage)
                ->subject('Gracias por enviarnos tu testimonio')
                ->line('Es una bendición el poder leer sobre lo que el Señor ha hecho en tu vida por medio del poder del Espíritu Santo.  Nos regocijamos y le damos la gloria a Dios!   Gracias por compartir tu historia con nosotros!')
                ->line('Gracias por amarnos y por apoyarnos para que podamos seguir compartiendo el evangelio de Jesús alrededor del mundo.')
                ->line('Oramos para que el Señor sea glorificado por medio de tu vida!')
                ->line('Eres amado,')
                ->line('Andres y Giannina Bisonni')
                ->line('www.EspirituSanto.com')
                ->line('Y el Dios de esperanza os llene de todo gozo y paz en el creer, para que abundéis en esperanza por el poder del Espíritu Santo.  (Romanos 15:13)');
        }
        
        if (app()->getLocale() === 'iw') {
            return (new MailMessage)
                ->subject('תודה ששלחת לנו את עדותך')
                ->line('זאת ברכה לשמוע מה שהאדון עשה בחייכם בכוח רוח הקודש. אנו שמחים איתך ונותנים לאלוהים את התהילה! תודה ששיתפת אותנו את הסיפור שלך!')
                ->line('אנו גם מודים לך על שאהבת אותנו ותמכת בנו בזמן שאנחנו ממשיכים ללכת לכל העולם לחלוק את הבשורה הטובה של ישוע.')
                ->line('אנו מתפללים שהאדון יתפאר בחייכם ודרככם!')
                ->line('אתה אהוב,')
                ->line('Andres and Giannina Bisonni')
                ->line('www.HolySpirit.tv')
                ->line('"ואלהי התקוה ימלא אתכם כל שמחה ושלום באמונתכם, כדי שתגאה בכם התקוה בכח רוח הקדש." אל הרומים טו 13');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
