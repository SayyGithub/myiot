<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class SensorController extends Controller
{
    public function index(Request $request)
    {
        try {
            $sensors = Sensor::latest()->get();

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'code' => Response::HTTP_OK,
                    'message' => 'Berhasil mendapatkan data sensor',
                    'data' => $sensors,
                ], Response::HTTP_OK);
            }

            return view('sensor.index', compact('sensors'));
        } catch (Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'fail',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Gagal mendapatkan data sensor',
                    'data' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return redirect()->back()->with('error', 'Gagal mendapatkan data sensor');
        }
    }

    public function create()
    {
        return view('sensor.create');
    }

    public function edit(Sensor $sensor)
    {
        return view('sensor.edit', compact('sensor'));
    }

    public function show($id)
    {
        try {
            $sensor = Sensor::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'code' => Response::HTTP_OK,
                'message' => "Berhasil mendapatkan data sensor dengan ID $id",
                'data' => $sensor,
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'fail',
                'code' => Response::HTTP_NOT_FOUND,
                'message' => "Data sensor dengan ID $id tidak ditemukan",
                'data' => null,
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_sensor' => ['required', 'string'],
                'data' => ['required'],
                'topik' => ['nullable', 'string'],
            ], [
                'nama_sensor.required' => 'Nama sensor harus diisi.',
                'data.required' => 'Data sensor harus diisi.',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $sensor = Sensor::create([
                'nama_sensor' => $request->nama_sensor,
                'data' => $request->data,
                'topik' => $request->topik,
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'code' => Response::HTTP_CREATED,
                    'message' => 'Berhasil menyimpan data sensor',
                    'data' => $sensor,
                ], Response::HTTP_CREATED);
            }

            return redirect()->route('sensor.index')->with('success', 'Sensor berhasil ditambahkan');
        } catch (ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'fail',
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Validasi gagal',
                    'data' => $e->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'fail',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Gagal menyimpan data sensor',
                    'data' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return redirect()->back()->with('error', 'Gagal menyimpan data sensor');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $sensor = Sensor::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'nama_sensor' => ['required', 'string'],
                'data' => ['required'],
                'topik' => ['nullable', 'string'],
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $sensor->update([
                'nama_sensor' => $request->nama_sensor,
                'data' => $request->data,
                'topik' => $request->topik,
            ]);
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'code' => Response::HTTP_OK,
                    'message' => "Berhasil mengubah data sensor dengan ID $id",
                    'data' => $sensor,
                ], Response::HTTP_OK);
            }

            return redirect()->route('sensor.index')->with('success', 'Sensor berhasil diupdate');
        } catch (ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'fail',
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Validasi gagal',
                    'data' => $e->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (ModelNotFoundException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'fail',
                    'code' => Response::HTTP_NOT_FOUND,
                    'message' => "Data sensor dengan ID $id tidak ditemukan",
                    'data' => null,
                ], Response::HTTP_NOT_FOUND);
            }

            return redirect()->route('sensor.index')->with('error', 'Data sensor tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        try {
            $sensor = Sensor::findOrFail($id);
            $sensor->delete();

            if (request()->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'code' => Response::HTTP_OK,
                    'message' => "Berhasil menghapus data sensor dengan ID $id",
                    'data' => $sensor,
                ], Response::HTTP_OK);
            }

            return redirect()->route('sensor.index')->with('success', 'Sensor berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'status' => 'fail',
                    'code' => Response::HTTP_NOT_FOUND,
                    'message' => "Data sensor dengan ID $id tidak ditemukan",
                    'data' => null,
                ], Response::HTTP_NOT_FOUND);
            }

            return redirect()->route('sensor.index')->with('error', 'Data sensor tidak ditemukan');
        }
    }
}