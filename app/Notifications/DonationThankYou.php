<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DonationThankYou extends Notification
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

        if(app()->getLocale() === 'en'){
            return (new MailMessage)
                ->subject('Thank you for your decision to support the ministry.')
                ->greeting('Dear Partner,')
                ->line('Thank you for your decision to support the ministry as we continue to go to the nations to share the gospel.  Your love and support is crucial for us to be able to take the love and power of Jesus around the world!   Doors are opening all over the world, and it is our desire to share the gospel with as many people as possible so that they may receive the gift of eternal life through faith in Jesus Christ.  Thank you for making it possible!!')
                ->line('After singing up through Paypal you should have been redirected to the website to create your partner account.  Through this account, you will have online access the book “My Beloved Holy Spirit,” and the full teachings from different conferences.  Please let us know if you were not redirected or if you had problems creating your new partner account.  ')
                ->line('If you live in the United States, and you signed up as a partner with $10 or more per month, we will also be mailing you a copy of the book, "My Beloved Holy Spirit."  Please allow a few days for delivery. ')
                ->line('We pray for the book and teachings to be a blessing to your life!')
                ->line('Thank you for loving us and sending us to the nations to share the gospel!  We will continually pray for the Lord to bless your life and family.')
                ->line('His,')
                ->line('Andres, Giannina, Elijah, Anabella and James Bisonni')
                ->line('https://www.HolySpirit.tv')
                ->line('"May the God of hope fill you with all joy and peace as you trust in him, so that you may overflow with hope by the power of the Holy Spirit." Romans 15:13');
        }

        if(app()->getLocale() === 'es'){
            return (new MailMessage)
                ->subject('Queremos agradecerle por su decisión de apoyar al ministerio para que podamos seguir yendo a las naciones a compartir el evangelio.')
                ->greeting('Querido patrocinador,')
                ->line('Queremos agradecerle por su decisión de apoyar al ministerio para que podamos seguir yendo a las naciones a compartir el evangelio. Su amor y apoyo es crucial para que podamos llevar el amor y el poder del Espíritu Santo alrededor del mundo! Las puertas se siguen abriendo en muchos países, y es nuestro deseo el compartir el evangelio con la mayor cantidad de personas posible para que puedan recibir el regalo de la vida eterna por medio de la fe en Jesucristo. Gracias por hacerlo posible!!')
                ->line('Al confirmar su información le estaremos enviando un correo electrónico con un enlace para registrase como socio del ministerio. Por medio de esta cuenta va a poder acceder en linea al libro “Mi Amado Espirítu Santo,” y las enseñanzas en video de diferentes conferencias. Si vive en los Estados Unidos, y se a registrado como patrocinador con una contribución de $10 o mas por mes, también le estaremos enviando en los próximos dias la copia del libro, “Mi Amado Espíritu Santo.”')
                ->line('Oramos para que el libro y las enseñanzas sean de gran bendición para su vida!')
                ->line('Gracias por todo su amor y apoyo! Oramos continuamente para que el Señor bendiga su vida y su familia.')
                ->line('En Cristo,')
                ->line('Andrés, Giannina, Elijah, Anabella y James Bisonni')
                ->line('https://www.EspirituSanto.com');
         }

        if(app()->getLocale() === 'iw'){
            return (new MailMessage)
                ->subject('Thank you for your decision to support the ministry.')
                ->greeting('שותף יקר,')
                ->line('תודה על החלטתך לתמוך בארגון בזמן שאנחנו ממשיכים ללכת לאומות לחלוק את הבשורה. אהבתך ותמיכתך חיוניים לנו כדי שנוכל לקחת את אהבתו וכוחו של ישוע ברחבי העולם! דלתות נפתחות בכל העולם, ורצוננו לחלוק את הבשורה עם כמה שיותר אנשים כדי שיקבלו את מתנת חיי הנצח באמצעות האמונה בישוע המשיח.
תודה, בזכותך זה אפשרי !!!')
                ->line('לאחר הרשמתך באמצעות Paypal תנותב לאתר ליצירת חשבון השותף שלך. באמצעות חשבון זה תהיה לך גישה מקוונת לספר "רוח הקודש – זו שאהבה נפשי", ולשיעורים מלאים מכנסים שונים. אנא יידע אותנו אם לא נותבת או אם נתקלת בבעיות ביצירת חשבון השותף החדש שלך.')
                ->line('אם אתה גר בארצות הברית ונרשמת כשותף עם 10 דולר ומעלה לחודש, אנו נשלח אליך גם עותק של הספר "רוח הקודש אהובתי". אנא המתן מספר ימים למסירה.')
                ->line('אנו מתפללים שהספר והשיעורים יהוו ברכה לחייכם!')
                ->line('תודה שאהבת אותנו ושלחת אותנו לאומות לחלוק את הבשורה! אנו מתפללים ללא הרף שאלוהים יברך את חייך ומשפחתך.')
                ->line('שלו,')
                ->line('אנדרס, גיאנינה, אליהו, אנאבלה וגיימס ביסוני')
                ->line('https://www.HolySpirit.tv')
                ->line('"ואלהי התקוה ימלא אתכם כל שמחה ושלום באמונתכם, כדי שתגאה בכם התקוה בכח רוח הקדש." אל הרומים טו 13');
        }

        if(app()->getLocale() === 'it'){
            return (new MailMessage)
                ->subject('Thank you for your decision to support the ministry.')
                ->greeting('Caro Collaboratore,')
                ->line('Grazie per la tua decisione di sostenere il ministero mentre continuiamo ad andare nelle nazioni per condividere il Vangelo. Il tuo amore e il tuo sostegno sono fondamentali per noi per poter portare l\'amore e il potere di Gesù in tutto il mondo! Le porte si stanno aprendo in tutto il mondo ed è nostro desiderio condividere il Vangelo con quante più persone possibile in modo che possano ricevere il dono della vita eterna attraverso la fede in Gesù Cristo.
                Grazie per averlo reso possibile !!
                ')
                ->line('Dopo esserti registrato tramite Paypal dovresti essere stato reindirizzato al sito web per creare il tuo account partner. Tramite questo account, avrete accesso in linea al libro "Mio Amato Spirito Santo" e agli insegnamenti completi di diverse conferenze. Facci sapere se non sei stato reindirizzato o se hai avuto problemi con la creazione del tuo nuovo account partner. ')
                ->line('Se vivi negli Stati Uniti e ti sei iscritto come partner con $ 10 o più al mese, ti invieremo anche una copia del libro "Mio Amato Spirito Santo".
                Si prega di attendere alcuni giorni per la consegna.
                 ')
                ->line('Preghiamo affinché il libro e gli insegnamenti siano una benedizione per la tua vita!')
                ->line('Grazie per amarci e permetterci di raggiungere le nazioni per condividere il Vangelo! Pregheremo continuamente affinché il Signore benedica la tua vita e la tua famiglia.')
                ->line('Suoi,')
                ->line('Andres, Giannina, Elijah, Anabella e James Bisonni')
                ->line('https://www.HolySpirit.tv')
                ->line('Or il Dio della speranza vi riempia di ogni gioia e di ogni pace nella fede, affinché abbondiate nella speranza, per la potenza dello Spirito Santo. Romani 15:13');
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
