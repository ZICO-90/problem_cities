<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\RegisterProblem;

class StatusProblemNotify extends Notification  
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $problem ;
    public function __construct(RegisterProblem $inject)
    {
        $this->problem = $inject ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
   
    public function toDatabase()
    {
        return [
            'id' =>  $this->problem->id ,
            'problem_name' =>  $this->problem->problem_name ,
            'order_status' => $this->problem->order_status,
            

        ];
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
            'id' =>  $this->problem->id ,
            'problem_name' =>  $this->problem->problem_name ,
            'order_status' => $this->problem->order_status
        ];
    }
}
