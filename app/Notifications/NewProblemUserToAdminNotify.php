<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\RegisterProblem;
class NewProblemUserToAdminNotify extends Notification implements ShouldBroadcast
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
        return ['database' ,'broadcast'];
    }

/**
 * Get the broadcastable representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return BroadcastMessage
 */

    public function toBroadcast($notifiable)
    {

        

        return new BroadcastMessage([
            
            'problem_id' =>  $this->problem->id ,
            'problem_name' =>  $this->problem->problem_name ,
            'user_name' =>  $this->problem->user->name  ,
            'to_admin' =>  $notifiable->name ,
            'count_notification' => $notifiable->unreadnotifications()->count(),
        ]);
   
    }

    /**
 * Get the type of the notification being broadcast.
 *
 * @return string
 */
public function broadcastType()
{
    return 'broadcast.message';
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
            'problem_id' =>  $this->problem->id ,
            'problem_name' =>  $this->problem->problem_name ,
            'user_name' =>  $this->problem->user->name  ,
            'to_admin' =>  $notifiable->name ,
           
            
        ];
    }
}
