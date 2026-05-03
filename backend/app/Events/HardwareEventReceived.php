<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HardwareEventReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $topic;
    public $data;

    /**
     * Create a new event instance.
     */
    public function __construct(string $topic, array $data)
    {
        $this->topic = $topic;
        $this->data = $data;
    }
}
