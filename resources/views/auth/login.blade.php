<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Password</label>
        <input type="password" name="password" required>

        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <div class="remember">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" style="margin:0;">Remember me</label>
        </div>

        <button class="btn" type="submit">Login</button>

        <div class="auth-links">
            <a href="{{ route('password.request') }}">Forgot Password?</a>
            <br>
            <a href="{{ route('register') }}">Belum punya akun? Register</a>
        </div>
    </form>
</x-guest-layout>