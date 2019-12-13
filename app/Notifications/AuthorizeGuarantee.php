<?php

namespace App\Notifications;

use App\Guarantee;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AuthorizeGuarantee extends Notification
{
    use Queueable;
    public $user,$guarantee;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( User $user,Guarantee $guarantee)
    {
        $this->user=$user;
        $this->guarantee=$guarantee;
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
        return (new MailMessage)
            ->subject('Guarantee Authorisation Request') // it will use this class name if you don't specify
            ->greeting('Good day '.$this->user->name) // example: Dear Sir, Hello Madam, etc ...
            ->level('success')// It is kind of email. Available options: info, success, error. Default: info
            ->line('A new guarantee captured requires your authorisation. Please logon to Loans Facility or click the button below to authorize the guarantee')
            ->action('Authorize', url('/authorizeGuarantee/'.$this->guarantee->id))
            ->line('Thank you for using the loans facility!');
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
