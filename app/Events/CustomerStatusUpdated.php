<?php

namespace App\Events;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerStatusUpdated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public array $data;

    public function __construct($user)
    {
        $this->data = [
            'id' => $user->id,
            'is_online' => (bool) $user->is_online,
        ];
    }

    public function broadcastOn()
    {
        return new PresenceChannel('customers.online');
    }

    public function broadcastAs()
    {
        return 'customer.status.updated';
    }
}
