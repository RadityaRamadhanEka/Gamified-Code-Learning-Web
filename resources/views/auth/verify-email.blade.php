<x-guest-layout>
<div class="auth-page">
    <div class="auth-card" style="text-align: center;">

        <a href="/" class="auth-logo">
            <div class="auth-logo__icon">⚡</div>
            <span class="auth-logo__text">Ngoding<span>AJG</span></span>
        </a>

        <div style="font-size: 3rem; margin-bottom: var(--space-4);">📬</div>
        <h1 class="auth-title">Cek Emailmu!</h1>
        <p class="auth-subtitle" style="margin-bottom: var(--space-6);">
            Kami sudah kirim link verifikasi ke email kamu. Klik link tersebut untuk mengaktifkan akun dan mulai kumpulkan XP!
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="auth-status" style="margin-bottom: var(--space-5);">
                ✅ Link verifikasi baru sudah dikirim ke emailmu.
            </div>
        @endif

        <div class="flex flex-col gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="auth-submit">
                    <span>📨</span> Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm w-full" style="margin-top: var(--space-2);">
                    Keluar dari Akun
                </button>
            </form>
        </div>
    </div>
</div>
</x-guest-layout>
