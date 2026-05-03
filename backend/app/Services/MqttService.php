<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Events\HardwareEventReceived;
use Illuminate\Support\Facades\Log;

class MqttService
{
    protected $client;
    protected $config;

    public function __construct()
    {
        $this->config = config('mqtt');
        
        $settings = (new ConnectionSettings)
            ->setKeepAliveInterval(60)
            ->setLastWillTopic('hardware/status/offline')
            ->setLastWillMessage(json_encode(['client_id' => $this->config['client_id'], 'status' => 'offline']))
            ->setLastWillQualityOfService(1)
            ->setRetainLastWill(true);

        // TLS/SSL Configuration
        if ($this->config['use_tls']) {
            $settings->setUseTls(true)
                     ->setTlsSelfSignedAllowed(false)
                     ->setTlsCertificateAuthorityFile($this->config['ca_file'])
                     ->setTlsClientCertificateFile($this->config['client_cert'])
                     ->setTlsClientCertificateKeyFile($this->config['client_key']);
        }

        $this->client = new MqttClient(
            $this->config['host'], 
            $this->config['port'], 
            $this->config['client_id']
        );
        
        $this->client->connect($settings, true);
    }

    public function sendCommand(string $deviceId, string $command, array $params = [])
    {
        $topic = "devices/{$deviceId}/commands";
        $payload = json_encode([
            'command' => $command,
            'params' => $params,
            'timestamp' => now()->toIso8601String()
        ]);

        $this->client->publish($topic, $payload, 1);
        Log::info("MQTT Command Sent: {$topic}", ['payload' => $payload]);
    }

    public function subscribeToEvents()
    {
        $this->client->subscribe('hardware/events/#', function (string $topic, string $message) {
            $data = json_decode($message, true);
            
            Log::info("MQTT Event Received: {$topic}", ['data' => $data]);
            
            event(new HardwareEventReceived($topic, $data));
        }, 1);

        $this->client->loop(true);
    }

    public function disconnect()
    {
        $this->client->disconnect();
    }
}
