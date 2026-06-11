<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::latest()->get();
        return view('device.index', compact('devices'));
    }

    public function create()
    {
        return view('device.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|numeric',
            'topik' => 'required|string',
        ]);

        Device::create([
            'serial_number' => $request->serial_number,
            'topik' => $request->topik,
        ]);

        return redirect()->route('device.index')
                         ->with('success', 'Device berhasil ditambahkan');
    }

    public function edit(Device $device)
    {
        return view('device.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        // $request->validate([
        //     'serial_number' => 'required|',
        //     'topik' => 'required|string',
        // ]);

        $device->update([
            'serial_number' => $request->serial_number,
            'topik' => $request->topik,
        ]);

        return redirect()->route('device.index')
                         ->with('success', 'Device berhasil diupdate');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('device.index')
                         ->with('success', 'Device berhasil dihapus');
    }
}