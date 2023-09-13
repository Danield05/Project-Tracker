<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Expenses;

class ExpenseAddedNotification extends Notification
{
    use Queueable;

    protected $expense;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Expenses $expense)
    {
        $this->expense = $expense;
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
            ->greeting('Hello!')
            ->line('A new expense has been added to your account')
            ->line('Expense Details')
            ->line('Type: ' . $this->expense->type)
            ->line('Date: ' . $this->expense->date)
            ->line('Description: ' . $this->expense->description)
            ->line('Amount: ' . $this->expense->amount)
            ->line('Status: ' . $this->expense->status)
            ->salutation('Thank you for using our application!')
            ->from('noreply@gmail.com', 'Expenses tracker app') // Cambia 'yourapp.com' al dominio de tu aplicación
            ->subject('New Expense Added');
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
