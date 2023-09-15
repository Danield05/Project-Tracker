<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Budget;
class UpdateBudget extends Notification
{
    use Queueable;
    protected $budget;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Budget $budget)
    {
        $this->budget = $budget;
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
     
        $budget = $this->budget; 
        
        return (new MailMessage)
        ->line('Edit Monthly Budget') 
        ->line('Month: ' . $budget->month) 
        ->line('Year: ' . $budget->year) 
        ->line('Budget Amount: ' . $budget->budget) 
        ->line('The budget has been updated.')
        ->line('Thank you for using our application!')
        ->from('noreply@yourapp.com', 'Expenses tracker app')
        ->subject('Update Monthly Budget');
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
