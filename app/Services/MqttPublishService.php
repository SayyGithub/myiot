<?php

namespace App\Services;

class MqttPublishService
{
    public static function getConfig()
    {
        return [
            'host' => config('mqtt.host'),
            'ws_port' => config('mqtt.ws_port'),
            'username' => config('mqtt.username'),
            'password' => config('mqtt.password'),
        ];
    }
}