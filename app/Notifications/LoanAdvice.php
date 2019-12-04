<?php

namespace App\Notifications;

use App\Customer;
use App\LoanSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LoanAdvice extends Notification
{
    use Queueable;
    public $customer;
    public $schedule;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Customer $customer,LoanSchedule $schedule)
    {
        //
        $this->customer=$customer;
        $this->schedule=$schedule;
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
            ->subject('Installments Repayment Schedule') // it will use this class name if you don't specify
            ->greeting('Dear '.$this->customer->full_name) // example: Dear Sir, Hello Madam, etc ...
            ->level('info')// It is kind of email. Available options: info, success, error. Default: info
            ->line('Please be advised that your next installment for period '.$this->schedule->period.' of loan '.$this->schedule->loan_id.' is due on '.$this->schedule->end_date.'. To avoid being penalised for late payments, kindly visit your Agribank branch and  settle your dues on time' )
            ->line('Thank you for choosing Agribank, Your all weather bank')
            ->salutation('Regards Agribank Loans Team');
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

        ];
    }
}
