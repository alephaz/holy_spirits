<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserRegistered extends Notification
{
    use Queueable;
    private $user;
    private $password;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        //
        $this->user = $user;
        $this->password = $password;
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

        if ($this->user->locale == 'en') {
            return (new MailMessage)
                ->subject('New password for your partner account')
                ->greeting('Dear Partners,')
                ->line('Thank you for supporting the ministry and making it possible for us to continue to share the gospel around the world.  Several people had trouble resetting their password on the new website, so we decided that it would be better for us to create a new password for you to login to your partner account.  After signing in you may change this password to the one you choose.  From your account you will be able to read the book "My Beloved Holy Spirit," and also have access to the teachings from different conferences and crusades.')
                ->line('Please use the following details to access your account.')
                ->line('Email : ' . $this->user->email)
                ->line('Password : ' . $this->password)
                ->line('Social media is a powerful tool in our generation to share the gospel around the world.  This is the main reason why we created this new website.  We want to facilitate the option for people to share video compilations, so that many more lives will be able to hear and receive the gift of eternal life and the gift of the Holy Spirit.  There are millions of people around the world who still need to hear the gospel, and it is our desire to use every mean possible to bring them the good news of salvation through faith in Jesus.  We continue to minister in conferences, crusades and youth events in different nations.  We are also producing videos and TV programs, and with this new website, we hope to use social media for the glory of Jesus.  We believe that the call to share the gospel is urgent and of eternal significance.  It is our desire to share the gospel in love and power, and represent Jesus with integrity and excellency.  His love for us, and our love for him is what motivates us.')
                ->line('Thank you for loving us, and believing in this ministry.  Together we are fulfilling his commission:  “Go into all the world and preach the gospel to every creature.” Mark 16:15')
                ->line('We pray for the Lord to continue to bless you, and for Jesus to be glorified through your life!')
                ->line('Andres, Giannina, Elijah, Anabella and James Bisonni')
                ->line('www.HolySpirit.tv');
        }

        if ($this->user->locale == 'es') {
            return (new MailMessage)
                ->subject('Nueva contraseña para su cuenta de patrocinador')
                ->greeting('Queridos Patrocinadores,')
                ->line('Gracias por apoyar el ministerio permitiendonos seguir llevando el evangelio a las naciones.  Varias personas tuvieron problemas reseteando sus contraseñas en la nueva página web, entonces hemos decidido que sería mejor que nosotros le eviemos una nueva contraseña para que pueda entrar en su cuenta de patrocinador.  Despues de entrar va a poder cambiar la contraseña a la que usted quiera.  Desde esta cuenta va a poder leer el libro "Mi Amado Espíritu Santo," y también va a tener acceso a las enseñanzas desde diferentes conferencias y cruzadas.')
                ->line('Utilice los siguientes detalles para acceder a su cuenta.')
                ->line('Tu correo electrónico : ' . $this->user->email)
                ->line('Contraseña : ' . $this->password)
                ->line('Las redes sociales son una poderosa herramienta en nuestra generación para compartir el evangelio alrededor del mundo.  Esta es la razón principal por la cual hemos creado esta nueva página web.  Queremos facilitar la opción para que las personas puedan compartir los videos y así muchas mas personas podrán escuchar y recibir el don de la vida eterna y el don del Espíritu Santo.  Hay millones de personas alrededor del mundo que todavía necesitan escuchar el evangelio, y es nuestro deseo el usar todos los medios posibles para llevarles la buenas noticias de salvación por medio de la fe en Jesucristo.  Seguimos ministrando en conferencias, cruzadas y eventos de jóvenes en diferentes naciones.  También estamos produciendo videos y programas de televisión, y ahora por medio de esta nueva página web, queremos usar las redes sociales para la gloria de Jesús.  Creemos que el llamado a compartir el evangelio es urgente y tiene una importancia eterna.  Es nuestro deseo el compartir el evangelio con amor y poder, y representar a Jesús con integridad y excelencia.  Su amor por nosotros y nuestro amor por el es lo que nos motiva.')
                ->line('Gracias por amarnos y por creer en este ministerio.  Juntos estamos cumpliendo su comisión:  "Id por todo el mundo y predicad el evangelio a toda criatura.” Marcos 16:15')
                ->line('Oramos para que el Señor le siga bendiciendo y para que Jesús sea glorificado por medio de su vida!')
                ->line('Andres, Giannina, Elijah, Anabella y James Bisonni')
                ->line('www.EspirituSanto.com');
        }

        if ($this->user->locale == 'iw') {
            return (new MailMessage)
                ->subject('סיסמה חדשה לחשבון השותף שלך')
                ->greeting('שותפים יקרים,')
                ->line('תודה שאתם תומכים בארגון ומאפשרי לנו להמשיך ולשתף את הבשורה ברחבי העולם. כמה אנשים התקשו לאפס את הסיסמה שלהם באתר החדש, ולכן החלטנו שעדיף לנו ליצור סיסמה חדשה בהתחברות לחשבון. לאחר הכניסה תוכלו לשנות את הסיסמה לזו שתבחרו. מחשבונך תוכל לקרוא את הספר "רוח הקודש – זאת שאהבה נפשי", וכן תהיה לך גישה לשיעורים מכנסים ומסעות שונים.')
                ->line('אנא השתמש בפרטים הבאים כדי לגשת לחשבונך')
                ->line('דואר אלקטרוני : ' . $this->user->email)
                ->line('סיסמא : ' . $this->password)
                ->line('המדיה החברתית הוא כלי רב עוצמה בדור שלנו כדי לחלוק את הבשורה ברחבי העולם. זו הסיבה העיקרית שבגללה יצרנו אתר זה. אנו רוצים להקל על האנשים לשתף אוספי וידיאו, כך שרבים יוכלו לשמוע ולקבל את מתנת חיי הנצח ואת מתנת רוח הקודש. ישנם מיליוני אנשים ברחבי העולם שעדיין צריכים לשמוע את הבשורה, וברצוננו להשתמש בכל האמצעים האפשריים כדי להביא להם את הבשורה הטובה על הגאולה באמצעות האמונה בישוע. אנו ממשיכים לשרת בכנסים, מסעות ואירועי נוער במדינות שונות. אנו גם מפיקים סרטונים ותוכניות טלוויזיה, ועם אתר זה אנו מקווים להשתמש ברשתות החברתיות לתפארת ישוע. אנו מאמינים כי הקריאה לחלוק את הבשורה היא דחופה ובעלת משמעות נצחית. הרצון שלנו לחלוק את הבשורה באהבה ובעוצמה, ולייצג את ישוע בשלמות ובמצוינות. אהבתו אלינו, ואהבתנו אליו היא זו שמניעה אותנו. ')
                ->line('יחד אנו ממלאים את יעודותנו: "לְכוּ אֶל־כָּל־הָעוֹלָם וְקִרְאוּ אֶת־הַבְּשׂוֹרָה לְכָל־הַבְּרִיאָה." מרקוס טז 15:')
                ->line('אנו מתפללים שהאלוהים ימשיך לברך אותך, ושישוע יהיה מהולל בחייך!')
                ->line('אנו מתפללים אנדרס, גיאנינה, אליהו, אנאבלה וגיימס ביסוני!')
                ->line('www.HolySpirit.tv');
        }

        if ($this->user->locale == 'it') {
            return (new MailMessage)
                ->subject('Nuova password per il tuo account collaboratore')
                ->greeting('Caro Collaboratore,')
                ->line("Grazie per il sostegno al ministero e per averci reso possibile continuare a condividere il Vangelo in tutto il mondo. Diverse persone hanno avuto problemi a reimpostare la password sul nuovo sito Web, quindi abbiamo deciso che sarebbe stato meglio per noi creare una nuova password per accedere al tuo account. Dopo aver effettuato l'accesso, puoi cambiare questa password con quella che hai scelto. Dal tuo account potrai leggere il libro \"Mio amato Spirito Santo\" e avere accesso anche agli insegnamenti di diverse conferenze e crociate.")
                ->line('Si prega di utilizzare i seguenti dettagli per accedere al proprio accoun.')
                ->line('email : ' . $this->user->email)
                ->line('password : ' . $this->password)
                ->line("I social media sono uno strumento potente nella nostra generazione per condividere il Vangelo in tutto il mondo. Questo è il motivo principale per cui abbiamo creato questo nuovo sito web. Vogliamo facilitare la possibilità per le persone di condividere compilation video, in modo che molte più vite possano ascoltare e ricevere il dono della vita eterna e il dono dello Spirito Santo. Ci sono milioni di persone in tutto il mondo che hanno ancora bisogno di ascoltare il Vangelo, ed è nostro desiderio usare ogni mezzo possibile per portare loro la buona notizia della salvezza attraverso la fede in Gesù. Continuiamo a svolgere il ministero in conferenze, crociate ed eventi giovanili in diverse nazioni. Stiamo anche producendo video e programmi TV e, con questo nuovo sito web, speriamo di utilizzare i social media per la gloria di Gesù. Crediamo che la chiamata a condividere il Vangelo sia urgente e di significato eterno. È nostro desiderio condividere il Vangelo con amore e potenza rappresentando Gesù con integrità ed eccellenza. Il suo amore per noi e il nostro amore per lui è ciò che ci motiva.")
                ->line('Grazie per amarci e credere in questo ministero. Insieme stiamo adempiendo al suo incarico: "Andate in tutto il mondo e predicate il Vangelo a ogni creatura". Marco 16:15')
                ->line('Preghiamo che il Signore continui a benedirti e che Gesù sia glorificato attraverso la tua vita!')
                ->line('Andres, Giannina, Elijah, Anabella e James Bisonni')
                ->line('www.italian.holyspirit.tv');
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
