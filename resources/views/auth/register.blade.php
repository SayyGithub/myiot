<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus>

        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Password</label>
        <input type="password" name="password" required>

        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>

        <button class="btn" type="submit">Register</button>

        <div class="auth-links">
            <a href="{{ route('login') }}">Sudah punya akun? Login</a>
        </div>
    </form>
</x-guest-layout>