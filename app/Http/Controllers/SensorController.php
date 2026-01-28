<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::latest()->get();
        return view('sensor.index', compact('sensors'));
    }

    public function create()
    {
        return view('sensor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sensor' => 'required|string',
            'data' => 'required|numeric',
        ]);

        Sensor::create([
            'nama_sensor' => $request->nama_sensor,
            'data' => $request->data,
        ]);

        return redirect()->route('sensor.index')
                         ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Sensor $sensor)
    {
        return view('sensor.edit', compact('sensor'));
    }

    public function update(Request $request, Sensor $sensor)
    {
        $request->validate([
            'nama_sensor' => 'required|string',
            'data' => 'required|numeric',
        ]);

        $sensor->update([
            'nama_sensor' => $request->nama_sensor,
            'data' => $request->data,
        ]);

        return redirect()->route('sensor.index')
                         ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Sensor $sensor)
    {
        $sensor->delete();

        return redirect()->route('sensor.index')
                         ->with('success', 'Data berhasil dihapus');
    }
}
