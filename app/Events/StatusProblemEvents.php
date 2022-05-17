<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatusProblemEvents implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $status ;
    public $counts ;
    public function __construct( $model , $count )
    {
        $this->status = $model ;
        $this->counts = $count ;

     // dd($this->status);
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    /*
    public function broadcastOn()
    {
       
        return new Channel('status-problem');

    }
    */

    public function broadcastOn()
{
    return new Channel('status-problem.'.$this->status->user_id);
}
}
