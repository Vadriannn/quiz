<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Daftar Akun · Adminator</title>
    <script>
        !function(){
            try {
                var t = localStorage.getItem("dash26-theme"),
                    e = window.matchMedia("(prefers-color-scheme: dark)").matches;
                document.documentElement.setAttribute("data-theme", t || (e ? "dark" : "light"));
            } catch(t) {
                document.documentElement.setAttribute("data-theme", "light");
            }
        }();
    </script>
    <script defer="defer" src="{{ asset('adminator/runtime.js') }}"></script>
    <script defer="defer" src="{{ asset('adminator/vendor-fullcalendar.js') }}"></script>
    <script defer="defer" src="{{ asset('adminator/vendor-chartjs.js') }}"></script>
    <script defer="defer" src="{{ asset('adminator/vendors.js') }}"></script>
    <script defer="defer" src="{{ asset('adminator/2026.js') }}"></script>
    <link href="{{ asset('adminator/style.css') }}" rel="stylesheet">
</head>
<body>
        <main class="auth-main">
            <div class="auth-main-top">
                <a href="{{ url('/') }}" style="font-size:12.5px;color:var(--t-muted);display:inline-flex;align-items:center;gap:6px">
                    <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Beranda
                </a>
                <div class="switch-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                </div>
            </div>

            <div class="auth-card">
                <h2>Buat Akun Baru</h2>
                <p class="sub">Lengkapi formulir di bawah ini untuk membuat akun pegawai.</p>

                @if ($errors->any())
                    <div style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid var(--danger, #ef4444); padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 13.5px; color: var(--danger, #ef4444);">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form class="auth-form" method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="field">
                        <label class="field-label" for="nama">Nama Lengkap / Username</label>
                        <input id="nama" name="nama" class="input" type="text" placeholder="Contoh: Budi Santoso" value="{{ old('nama') }}" required autofocus>
                    </div>

                    <div class="field">
                        <label class="field-label" for="email">Email</label>
                        <div class="input-icon">
                            <span class="ico">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="m3 7 9 6 9-6"/>
                                </svg>
                            </span>
                            <input id="email" name="email" class="input" type="email" placeholder="budi@gmail.com" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="notelp">No. Telepon (Opsional)</label>
                        <input id="notelp" name="notelp" class="input" type="text" placeholder="08123456789" value="{{ old('notelp') }}">
                    </div>

                    <div class="field">
                        <label class="field-label" for="password">Password</label>
                        <div class="input-icon">
                            <span class="ico">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input id="password" name="password" class="input" type="password" placeholder="Minimal 4 karakter" required minlength="4">
                        </div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-icon">
                            <span class="ico">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input id="password_confirmation" name="password_confirmation" class="input" type="password" placeholder="Ulangi password" required minlength="4">
                        </div>
                    </div>

                    <button class="btn btn--primary auth-submit" type="submit" style="width: 100%; margin-top: 10px;">
                        Daftar Akun
                        <svg viewBox="0 0 24 24">
                            <path d="M5 12h14M13 5l7 7-7 7"/>
                        </svg>
                    </button>
                </form>
            </div>
            <div class="auth-main-bottom">
                Sudah memiliki akun? <a href="{{ route('login') }}" style="color:var(--primary);font-weight:600">Masuk di sini</a>
            </div>
        </main>
    </div>
</body>
</html>
