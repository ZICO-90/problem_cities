<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewProblemUserToAdminNotifyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user ;
    public $adminid ;
    public $problem;
    public $unreadCountNotifyAdmin;

    public function __construct($info_user , $id_admin ,$info_problem , $count_notify   )
    {
        $this->user = $info_user ;
        $this->adminid = $id_admin ;
        $this->problem = $info_problem ;
        $this->unreadCountNotifyAdmin = $count_notify ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-name');
    }
}
