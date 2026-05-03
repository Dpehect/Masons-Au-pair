<?php

namespace App\Listeners;

use App\Events\HardwareEventReceived;
use Illuminate\Support\Facades\Log;
use App\Models\Device;

class ProcessHardwareEvent
{
    public function handle(HardwareEventReceived $event): void
    {
        $topicParts = explode('/', $event->topic);
        $eventType = $topicParts[2] ?? 'unknown';

        switch ($eventType) {
            case 'alarm':
                $this->handleAlarm($event->data);
                break;
            case 'entry':
                $this->handleEntry($event->data);
                break;
            case 'heartbeat':
                $this->updateDeviceStatus($event->data);
                break;
        }
    }

    protected function handleAlarm($data)
    {
        Log::critical("SECURITY ALARM TRIGGERED!", $data);
    }

    protected function handleEntry($data)
    {
        Log::info("Access Event recorded.", $data);
    }

    protected function updateDeviceStatus($data)
    {
        if (isset($data['device_id'])) {
            Device::where('device_id', $data['device_id'])
                  ->update(['last_seen_at' => now(), 'status' => 'online']);
        }
    }
}
