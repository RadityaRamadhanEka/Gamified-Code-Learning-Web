<x-guest-layout>
<div class="auth-page">
    <div class="auth-card">

        <a href="/" class="auth-logo">
            <div class="auth-logo__icon">⚡</div>
            <span class="auth-logo__text">Ngoding<span>AJG</span></span>
        </a>

        <h1 class="auth-title">Lupa Password?</h1>
        <p class="auth-subtitle">Tenang, kami kirimkan link reset ke emailmu 📧</p>

        @if (session('status'))
            <div class="auth-status" style="margin-bottom: var(--space-5);">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">📧 Email Terdaftar</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="nama@email.com"
                    class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                >
                @error('email')
                    <span class="form-error">⚠ {{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="auth-submit">
                <span>📨</span> Kirim Link Reset
            </button>
        </form>

        <div class="auth-footer">
            <p>Ingat password? <a href="{{ route('login') }}">← Kembali ke Login</a></p>
        </div>
    </div>
</div>
</x-guest-layout>
