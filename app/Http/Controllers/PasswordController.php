<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        if (Auth::user()->role === 'admin') {
            abort(403);
        }

        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            abort(403);
        }

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama salah.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('device.index')->with('success', 'Password berhasil diubah.');
    }
}