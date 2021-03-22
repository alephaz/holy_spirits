<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRequest extends Notification
{
    use Queueable;

    /**
     * @var UserRequest
     */
    private $userRequest;

    /**
     * Create a new notification instance.
     *
     * @param UserRequest $userRequest
     */
    public function __construct(\App\Models\UserRequest $userRequest)
    {
        // request params
        $this->userRequest = $userRequest;
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

        // show message based on the type
        if ($this->userRequest->request_type === 'prayer_request') {
            return (new MailMessage)
                ->subject('A Prayer request received from ' . $this->userRequest->name)
                ->replyTo($this->userRequest->email)
                ->line('Dear Admin,')
                ->line('A new prayer request has been received from ' . $this->userRequest->name)
                ->line('With email : '. $this->userRequest->email)
                ->line('With request :')
                ->line($this->userRequest->message)
                ->line('You can view this message from the backend using the following link.')
                ->action('View', '/admin/resources/user-requests/' . $this->userRequest->id);
        }

        if ($this->userRequest->request_type === 'contact_request') {
            return (new MailMessage)
                ->subject('A Contact request received from ' . $this->userRequest->name)
                ->replyTo($this->userRequest->email)
                ->line('Dear Admin,')
                ->line('A new contact request has been received from ' . $this->userRequest->name)
                ->line('With email : '. $this->userRequest->email)
                ->line('With message :')
                ->line($this->userRequest->message)
                ->line('You can view this message from the backend using the following link.')
                ->action('View', '/admin/resources/user-requests/' . $this->userRequest->id);
        }

        if ($this->userRequest->request_type === 'comment_question') {
            return (new MailMessage)
                ->line('Dear Admin,')
                ->subject('A new comment / question received from ' . $this->userRequest->name)
                ->replyTo($this->userRequest->email)
                ->line('A new comment / question has been received from ' . $this->userRequest->name)
                ->line('With email : '. $this->userRequest->email)
                ->line('With comment / question :')
                ->line($this->userRequest->message)
                ->line('You can view this message from the backend using the following link.')
                ->action('View', '/admin/resources/user-requests/' . $this->userRequest->id);
        }

        if ($this->userRequest->request_type === 'book_request') {
            return (new MailMessage)
                ->subject('A new newsletter subscription from ' . $this->userRequest->name)
                ->replyTo($this->userRequest->email)
                ->line('Dear Admin,')
                ->line('A new newsletter subscription from ' . $this->userRequest->name)
                ->line('With email : '. $this->userRequest->email)
                ->line('You can view this request from the backend using the following link.')
                ->action('View', '/admin/resources/user-requests/' . $this->userRequest->id);
        }

        if ($this->userRequest->request_type === 'testimony') {
            return (new MailMessage)
                ->subject('A testimony has been received from ' . $this->userRequest->name)
                ->replyTo($this->userRequest->email)
                ->line('Dear Admin,')
                ->line('A testimony has been received from ' . $this->userRequest->name)
                ->line('With email : '. $this->userRequest->email)
                ->line('With testimony :')
                ->line($this->userRequest->message)
                ->line('You can view this message from the backend using the following link.')
                ->action('View', '/admin/resources/user-requests/' . $this->userRequest->id);
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
