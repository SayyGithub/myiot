<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_sensor' => 'required|string',
            'data' => 'required',
            'topik' => 'nullable|string',
        ]);

        $sensor = Sensor::create([
            'nama_sensor' => $request->nama_sensor,
            'data' => $request->data,
            'topik' => $request->topik,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data sensor berhasil disimpan',
            'data' => $sensor,
        ], 201);
    }
}