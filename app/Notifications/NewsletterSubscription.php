<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewsletterSubscription extends Notification
{
    use Queueable;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string|null
     */
    private $name;

    /**
     * Create a new notification instance.
     *
     * @param string $email
     * @param string|null $name
     */
    public function __construct(string $email, string $name = null)
    {
        //
        $this->email = $email;
        $this->name = $name;
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

        // check for the application language and send the translated message
        if (app()->getLocale() === 'en') {
            return (new MailMessage)
                ->replyTo('abm@abm.cc')
                ->subject('Thank you for subscribing to receive our latest videos!')
                ->greeting('Dear ' . ($this->name ? $this->name : $this->email) . ',')
                ->line('Thank you for subscribing to our latest videos!')
                ->line('We will be emailing you our latest videos from around the world as soon as they are produced.  Through these video compilations and TV episodes we hope to not only inform you about what the Holy Spirit is doing in different nations, but we also desire to encourage you to a deeper relationship with the Lord.')
                ->line('We pray for the the Holy Spirit to use these videos to bring healing, inspiration, motivation and transformation to your life.')
                ->line('We would also like to share the first chapter of the book, "My Beloved Holy Spirit."')
                ->line('To read this chapter simply click')
                ->action('Here', 'https://www.holyspirit.tv/page/book-chapter-one?language=en')
                ->line('We hope that this book will bring the revelation of the person and power of the Holy Spirit to many lives around the world!')
                ->line('Thank you for loving and supporting us as we continue to go into all the world to share the gospel of Jesus Christ in the power of the Holy Spirit!')
                ->line('His,')
                ->line('Andres, Giannina, Elijah, Anabella and James Bisonni')
                ->line('"In the last days, God says, I will pour out My Spirit upon all people." Joel 2:28');
        }

        if (app()->getLocale() === 'es') {
            return (new MailMessage)
                ->replyTo('abm@abm.cc')
                ->subject('El primer capitulo, "Cautivado por el Espiritu Santo" y próximamente los nuevos videos!')
                ->greeting(($this->name ? $this->name : $this->email) . ',')
                ->line('El primer capitulo, "Cautivado por el Espiritu Santo" y próximamente los nuevos videos!')
                ->line('Para leer el primer capitulo del libro, "Mi Amado Espiritu Santo," simplemente haz click')
                ->action('abajo', 'https://www.espiritusanto.com/page/book-chapter-one?language=es')
                ->line('También estaremos enviándote nuestros últimos vídeos de alrededor del mundo tan pronto como sean producidos.  A través de estos vídeos y episodios de televisión, esperamos no sólo informarte sobre lo que el Espíritu Santo está haciendo en el mundo, sino también deseamos animarte en tu relación con el Señor.')
                ->line('Es nuestra oración que el Espíritu Santo use estos videos para traer sanidad, inspiración, motivación y transformación a tu vida.')
                ->line('Gracias por tu amor y apoyo para con nosotros mientras continuamos con la tarea de llevar el Evangelio de Jesucristo a las naciones.')
                ->line('Andres y Giannina Bisonni')
                ->line('www.EspirituSanto.com')
                ->line('"Porque el Señor es el Espíritu; y donde está el Espíritu del Señor, allí hay libertad. Por tanto, nosotros todos, mirando a cara descubierta como en un espejo la gloria del Señor, somos transformados de gloria en gloria en la misma imagen, como por el Espíritu del Señor." 2 Corintios 3:17-18');
        }
        
        if (app()->getLocale() === 'iw') {
            return (new MailMessage)
                ->replyTo('abm@abm.cc')
                ->subject('תודה שנרשמת לקבלת הספר "רוח הקודש- זו שאהבה נפשי" והסרטונים האחרונים שלנו!')
                ->greeting('Dear ' . ($this->name ? $this->name : $this->email) . ',')
                ->line('תודה שנרשמת לסרטונים האחרונים שלנו ולספר "רוח הקודש- זו שאהבה נפשי "!')
                ->line('אנו נשלח אליך בדוא"ל את הסרטונים האחרונים שלנו מרחבי העולם. באמצעות אוספי הוידיאו אלה ופרקי הטלוויזיה אנו מקווים לא רק לשתף על ')
                ->line('עבודת רוח הקודש במדינות השונות, אלא רוצים באמצעותם לעודד אותך לקשר עמוק יותר עם האדון.')
                ->line('אנו מתפללים שרוח הקודש תשתמש בסרטונים אלה בכדי להביא ריפוי, השראה, מוטיבציה ושינוי בחייך.')
                ->line('ברצוננו לשלוח לך גם את הספר "רוח הקודש – זו שאהבה נפשי"')
                ->line('לקבלת הספר לחץ כאן:')
                ->action('כאן', 'https://holyspirit.tv/pdf/web/viewer.html?file=/storage/IkfdNUbwK01k4CKId81rIZpN38xOm0kBxaA1fvJR.pdf#magazineMode=true')
                ->line('תקוותנו שספר זה יביא התגלות לאישיותה וכוחה של רוח הקודש בחיים של רבים ברחבי העולם!')
                ->line('תודה שאתה אוהב ותומך בנו במטרתנו לחלוק עם כל העולם את הבשורה של ישוע בכוחו של רוח הקודש!')
                ->line('שלו,')
                ->line('אנדרס, גיאנינה, אליהו, אנאבלה וגיימס ביסוני')
                ->line('ת־רוּחִ י עַ ל־כָּ ל־בָּ שָׂ ר." יואל ג ֶפּוֹךְ אְשֶׁרֵ י־כֵ ן, אֲהָ יָה אַחְ"ו');
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
