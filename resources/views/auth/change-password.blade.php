@extends('layout.main')

@section('title', 'Reset Password')

@section('content')

<div class="header">
    <h1>Reset Password</h1>
</div>

<div class="form-card">
    <form action="{{ route('password.user.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-control">
            <label>Password Lama</label>
            <input type="password" name="current_password" required>
            @error('current_password')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label>Password Baru</label>
            <input type="password" name="new_password" required>
            @error('new_password')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn">Update Password</button>
    </form>
</div>

@endsection