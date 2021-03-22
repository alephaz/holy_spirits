<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ThankYouInvite extends Notification
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
                ->subject('Thank you for inviting us')
                ->line('Thank you for inviting us to minister in your city.  It is truly an honor for us to receive your invitation.')
                ->line('We are prayerfully considering your invitation.  Since we receive many invitations, many times we are not able to respond to all of them, but it is our desire to go to as many cities as possible to share the gospel of Jesus Christ.')
                ->line('It blesses and encourages us greatly every time we receive an invitation, and we hope to be able to minister in every nation someday!')
                ->line('Thank you for loving us and supporting us as we continue to go into all the world to share the good news of Jesus.')
                ->line('Please keep us in your prayers,')
                ->line('Andres and Giannina Bisonni')
                ->line('www.HolySpirit.tv')
                ->line('For the earth will be filled With the knowledge of the glory of the Lord, As the waters cover the sea. Habakkuk 2:14');
        }

        if (app()->getLocale() === 'es') {
            return (new MailMessage)
                ->subject('Gracias por invitarnos')
                ->line('Gracias por invitarnos a ministrar en su ciudad.  Es un honor para nosotros el poder recibir su invitación.')
                ->line('Estamos considerando y orando por su invitación.  Como recibimos muchas invitaciones, muchas veces no podemos responder a todas, pero es nuestro deseo el poder ir a todas la ciudades posibles para compartir el evangelio de Jesucristo.')
                ->line('Nos bendice y anima enormemente cada vez que recibimos una invitación, y esperamos poder ministrar en todas las naciones algún día!')
                ->line('Gracias por amarnos y por apoyarnos para que podamos seguir compartiendo el evangelio de Jesús alrededor del mundo,')
                ->line('Por favor manténganos en sus oraciones,')
                ->line('Andres y Giannina Bisonni')
                ->line('www.EspirituSanto.com')
                ->line('Porque la tierra será llena del conocimiento de la gloria de Jehová, como las aguas cubren el mar.  (Habacuc 2:14)');
        }
        
        if (app()->getLocale() === 'iw') {
            return (new MailMessage)
                ->subject('תודה שהזמנת אותנו')
                ->line('תודה שהזמנת אותנו לשרת בעירך. זה באמת כבוד עבורנו לקבל את הזמנתך.')
                ->line('אנו שוקלים בתפילה את הזמנתך. מכיוון שאנו מקבלים הזמנות רבות, פעמים רבות איננו מסוגלים לענות לכולן, אך ברצוננו להגיע לכמה שיותר ערים כדי לחלוק את הבשורה של ישוע המשיח.')
                ->line('אנחנו מעודדים ומבורכים מכל הזמנה, ומקווים שנוכל לשרת בכל אומה בזמן של אלוהים!')
                ->line('תודה על שאהבת אותנו ותמכת בנו בזמן שאנחנו ממשיכים ללכת לכל העולם לחלוק את הבשורה הטובה של ישוע.')
                ->line('אנא שמור אותנו בתפילותיך,')
                ->line('Andres and Giannina Bisonni')
                ->line('www.HolySpirit.tv')
                ->line('"כִּי תִּמָּלֵא הָאָרֶץ, לָדַעַת אֶת־כְּבוֹד יְהוָה; כַּמַּיִם יְכַסּוּ עַל־יָם׃ " חבקוק ב 14');
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
