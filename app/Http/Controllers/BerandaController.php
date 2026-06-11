<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Services\MqttPublishService;

class BerandaController extends Controller
{
    public function index()
    {
        $devices = Device::latest()->get();

        $mqtt = MqttPublishService::getConfig();

        return view('beranda', compact(
            'devices',
            'mqtt'
        ));
    }
}