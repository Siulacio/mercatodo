<?php

namespace App\Events;

use App\Models\ProductImages;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $image;

    public function __construct(ProductImages $image)
    {
        $this->image = $image;
    }

    public function broadcastOn() : array
    {
        return new PrivateChannel('channel-name');
    }
}
