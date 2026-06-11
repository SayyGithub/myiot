<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceStatusController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|string',
            'status' => 'required|string',
        ]);

        $device = Device::firstOrCreate(
    [
        'serial_number' => $request->serial_number,
    ],
    [
        'topik' => 'nusabot/device/' . $request->serial_number,
        'status' => 'Offline',
    ]
);

        $device->update([
            'status' => $request->status,
            'last_seen' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Status device berhasil diperbarui',
            'data' => $device,
        ]);
    }
}