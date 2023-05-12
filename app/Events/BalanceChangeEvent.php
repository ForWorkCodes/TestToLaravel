<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BalanceChangeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $type;
    public $balance_id;
    public $amount;
    public $status;
    public $description;

    /**
     * Create a new event instance.
     */
    public function __construct($user_id, $type, $balance_id, $amount, $status, $description = '')
    {
        $this->user_id = $user_id;
        $this->type = $type;
        $this->balance_id = $balance_id;
        $this->amount = $amount;
        $this->status = $status;
        $this->description = $description;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('balance-name'),
        ];
    }
}
