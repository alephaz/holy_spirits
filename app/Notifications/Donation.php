<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Donation extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    /**
     * @var \App\Models\Donation
     */
    private $donation;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Donation $donation
     */
    public function __construct(\App\Models\Donation $donation)
    {

        $this->donation = $donation;
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

        // check if the payment is from paypal and change the subject
        if ($this->donation->pay_pal_payment) {
            $subject = 'New PayPal Partner ' . $this->donation->name;
        } else {
            $subject = 'New Checking Account Partner ' . $this->donation->name;
        }


        return (new MailMessage)
            ->subject($subject)
            ->replyTo($this->donation->email)
            ->bcc('v.s.anandapiya@gmail.com')
            ->line('Dear Admin,')
            ->line('A donation has been received from ' . $this->donation->name)
            ->line('Language                : ' . strtoupper(app()->getLocale()))
            ->line('Name                    : ' . $this->donation->name)
            ->line('Last Name               : ' . $this->donation->last_name)
            ->line('Email                   : ' . $this->donation->email)
            ->line('Address                 : ' . $this->donation->address)
            ->line('City                    : ' . $this->donation->city)
            ->line('State                   : ' . $this->donation->state)
            ->line('Zip Code                : ' . $this->donation->zip_code)
            ->line('Telephone               : ' . $this->donation->telephone)
            ->line('Routing number          : ' . $this->donation->routing_number)
            ->line('Account number          : ' . $this->donation->account_number)
            ->line('Monthly contribution    : ' . ($this->donation->monthly_contribution ? $this->donation->monthly_contribution : '-'))
            ->line('Paypal Donation amount  : ' . ($this->donation->donation_amount ? $this->donation->donation_amount : '-'))
            ->line('You can view this message from the backend using the following link.')
            ->action('View', 'https://www.holyspirit.tv/admin/resources/donations/' . $this->donation->id);
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
