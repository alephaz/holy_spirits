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
                ->line('Gracias por amarnos y por apoyarnos para que podamos seguir compartiendo el evangelio de Jesús alrededor del mundo.')
                ->line('Oramos para que el Señor sea glorificado por medio de tu vida!')
                ->line('Eres amado,')
                ->line('Andres y Giannina Bisonni')
                ->line('www.EspirituSanto.com')
                ->line('Y el Dios de esperanza os llene de todo gozo y paz en el creer, para que abundéis en esperanza por el poder del Espíritu Santo.  (Romanos 15:13)');
        }

        if (app()->getLocale() === 'iw') {
            return (new MailMessage)
                ->subject('תודה ששלחת אלינו את תגובתך')
                ->line('תודה ששלחת אלינו את הערתך או שאלתך. אנו קוראים כל דוא"ל שאנו מקבלים, ורצוננו לענות לכמה שיותר.')
                ->line('אנו גם מודים לך על שאהבת אותנו ותמכת בנו בזמן שאנחנו ממשיכים ללכת לכל העולם לחלוק את הבשורה הטובה של ישוע.')
                ->line('אנו מתפללים שהאדון יתפאר בחייכם!')
                ->line('אתה אהוב,')
                ->line('אנדרס וגיאנינה ביזוני')
                ->line('www.HolySpirit.tv')
                ->line('"ואלהי התקוה ימלא אתכם כל שמחה ושלום באמונתכם, כדי שתגאה בכם התקוה בכח רוח הקדש." אל הרומים טו 13');
        }

        if (app()->getLocale() === 'it') {
            return (new MailMessage)
                ->subject('Grazie per averci inviato i tuoi commenti')
                ->line('Grazie per averci inviato la tua richiesta di preghiera. Pregheremo che il Signore soddisfi tutti i tuoi bisogni e ti dia i desideri del tuo cuore.')
                ->line('Grazie per amarci e sostenerci mentre continuiamo ad andare in tutto il mondo per condividere la buona notizia di Gesù.')
                ->line('Preghiamo affinché il Signore sia glorificato nella e attraverso la tua vita!')
                ->line('Sei amato,')
                ->line('Andres e Giannina Bisonni')
                ->line('www.italian.holyspirit.tv')
                ->line('Or il Dio della speranza vi riempia di ogni gioia e di ogni pace nella fede, affinché abbondiate nella speranza, per la potenza dello Spirito Santo. Romani 15:13.');
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
