<?php

namespace App\Notifications;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvitationNotification extends Notification
{
    use Queueable;
    /**
     * @var Invitation
     */
    private $invitation;

    /**
     * Create a new notification instance.
     *
     * @param Invitation $invitation
     */
    public function __construct(Invitation $invitation)
    {
        //
        $this->invitation = $invitation;
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

        return (new MailMessage)
            ->subject('A new invitation from ' . $this->invitation->email)
            ->replyTo($this->invitation->email)
            ->line('Dear Admin,')
            ->line('A new invitation is sent from ' . $this->invitation->email)
            ->line('Name                    : '. $this->invitation->name)
            ->line('Language                : '. strtoupper(app()->getLocale()))
            ->line('Church Name             : '. $this->invitation->church_name)
            ->line('Email                   : '. $this->invitation->email)
            ->line('Address                 : '. $this->invitation->address)
            ->line('City                    : '. $this->invitation->city)
            ->line('State                   : '. $this->invitation->state)
            ->line('Zip Code                : '. $this->invitation->zip_code)
            ->line('Country                 : '. $this->invitation->country)
            ->line('Telephone               : '. $this->invitation->telephone_phone)
            ->line('Mobile                  : '. $this->invitation->mobile_phone)
            ->line('Website                 : '. $this->invitation->website)
            ->line('Type                    : '. $this->invitation->event_type)
            ->line('Venue Capacity          : '. $this->invitation->venue_capacity)
            ->line('Expected attendance     : '. $this->invitation->expected_attendance)
            ->line('Tentative Dates         : '. $this->invitation->tentative_dates)
            ->line('Previous Event Details  : '. $this->invitation->previous_event_details)
            ->line('Message : '. $this->invitation->message)
            ->line('')
            ->line('Please use the following link to view the invitation on the website.')
            ->action('View', url('/admin/resources/invitations/' . $this->invitation->id))
            ->line('');
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
