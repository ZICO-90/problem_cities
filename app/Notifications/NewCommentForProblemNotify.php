<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\ProblemCommnet;

use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewCommentForProblemNotify extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $comments ;
    public function __construct(ProblemCommnet $inject)
    {
        $this->comments = $inject ;
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
        
        'problem_id' =>  $this->comments->Problem->id ,
        'problem_name' =>  $this->comments->Problem->problem_name ,
        'user_name' =>  $this->comments->user->name  ,
        'text_comment' =>  substr( $this->comments->commnets_body  ,0 , 16)  ,
        'count_notification' => $notifiable->unreadnotifications()->count(),
      
      
    ]);

}

public function broadcastType()
{
    return 'broadcast.comments';
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
        'problem_id' =>  $this->comments->Problem->id ,
        'problem_name' =>  $this->comments->Problem->problem_name ,
        'user_name' =>  $this->comments->user->name  ,
        'text_comment' =>  substr( $this->comments->commnets_body  ,0 , 30)  ,
        ];
    }
}
