<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - JokiDesainSaja</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        :root {
            --app-bg: #000000;
            --card-bg: rgba(17, 24, 39, 0.6);
            --border-color: #1f2937;
            --input-bg: #1f2937;
            --input-border: #374151;
            --text-primary: #e5e7eb;
            --text-secondary: #9ca3af;
            --text-placeholder: #6b7280;
            --accent-yellow: #facc15;
            --accent-yellow-hover: #eab308;
            --accent-red: #f87171;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: var(--app-bg);
            color: var(--text-primary);
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        
        /* ... CSS Lainnya (tidak berubah) ... */

        .login-card {
            background-color: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            max-width: 448px;
        }

        .header-container { max-width: 448px; position: relative; }
        
        .btn-back {
            color: var(--text-secondary); background-color: transparent; border: 1px solid var(--input-border);
            padding: 0.375rem 0.75rem; transition: all 0.2s ease-in-out; text-decoration: none;
        }
        .btn-back:hover { color: var(--text-primary); background-color: var(--input-border); text-decoration: none; }

        .form-control, .form-control:focus {
            background-color: var(--input-bg); border-color: var(--input-border);
            color: var(--text-primary); box-shadow: none;
        }
        .form-control:focus {
            border-color: var(--accent-yellow); box-shadow: 0 0 0 0.25rem rgba(250, 204, 21, 0.25);
        }
        .form-control::placeholder { color: var(--text-placeholder); }
        .form-control.is-invalid { border-color: var(--accent-red); }
        .form-control.is-invalid:focus { box-shadow: 0 0 0 0.25rem rgba(248, 113, 113, 0.25); }
        .invalid-feedback { color: var(--accent-red); }
        .input-group-text {
            background-color: var(--input-bg); border-color: var(--input-border); color: var(--text-secondary);
        }
        .btn-custom-yellow {
            background-color: var(--accent-yellow); border-color: var(--accent-yellow);
            color: #111827; font-weight: 700;
        }
        .btn-custom-yellow:hover {
            background-color: var(--accent-yellow-hover); border-color: var(--accent-yellow-hover); color: #111827;
        }
        a { color: var(--accent-yellow); text-decoration: none; }
        a:hover { color: var(--accent-yellow-hover); text-decoration: underline; }
        .form-check-input:checked { background-color: var(--accent-yellow); border-color: var(--accent-yellow); }

        /* === CSS ANIMASI BARU === */
        .animate-on-load {
            opacity: 0;
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .slide-from-top { transform: translateY(-20px); }
        .slide-from-bottom { transform: translateY(20px); }

        .animate-on-load.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Delay untuk animasi berurutan */
        .delay-1 { transition-delay: 0.2s; }
        .delay-2 { transition-delay: 0.4s; }
        /* === AKHIR CSS ANIMASI === */

    </style>
</head>
<body class="antialiased">
    
    <div class="container-fluid min-vh-100 d-flex flex-column align-items-center justify-content-center p-3">
        
        <header class="header-container w-100 mb-4 animate-on-load slide-from-top">
            <div class="d-flex justify-content-between align-items-center">
                <a href="/" class="btn btn-back d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                </a>
                <a href="/" class="h2 fw-bold link-underline-opacity-0 m-0 p-0 position-absolute top-50 start-50 translate-middle">
                    JokiDesainSaja
                </a>
            </div>
        </header>

        <main class="login-card p-4 p-sm-5 rounded-4 shadow-lg w-100 animate-on-load slide-from-bottom delay-1">
            <div class="text-center">
                <h1 class="h3 fw-bold">Selamat Datang Kembali</h1>
                <p style="color: var(--text-secondary);" class="mt-2 mb-4">Silakan masuk untuk melanjutkan.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><svg class="bi" width="16" height="16" fill="currentColor"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3.555ZM1 4.697v7.104l5.803-3.558L1 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/></svg></span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control @error('email') is-invalid @enderror" placeholder="anda@email.com">
                    </div>
                    @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><svg class="bi" width="16" height="16" fill="currentColor"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg></span>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                        <button type="button" id="togglePassword" class="btn btn-outline-secondary" style="border-color: var(--input-border);">
                            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.816 1.097-2.28 2.022-3.824 2.599C9.555 12.378 8.226 12.5 7 12.5c-1.226 0-2.555-.122-3.824-.599C1.493 10.022.357 9.097.357 8.599A13.133 13.133 0 0 1 0 8z"/><path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash d-none" viewBox="0 0 16 16"><path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/><path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/></svg>
                        </button>
                    </div>
                    @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                        <label class="form-check-label" for="remember_me" style="color: var(--text-secondary);">Ingat saya</label>
                    </div>
                    @if (Route::has('password.request')) <a href="{{ route('password.request') }}" class="small">Lupa password?</a> @endif
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom-yellow btn-lg">Login</button>
                </div>
                @if (Route::has('register'))
                    <p class="text-center small mt-4" style="color: var(--text-secondary);">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                    </p>
                @endif
            </form>
        </main>
        
        <footer class="text-center mt-4 animate-on-load slide-from-bottom delay-2">
            <p style="color: var(--text-secondary);">&copy; {{ date('Y') }} JokiDesainSaja</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            if(togglePassword) {
                const password = document.getElementById('password');
                const eyeOpen = document.getElementById('eye-open');
                const eyeClosed = document.getElementById('eye-closed');

                togglePassword.addEventListener('click', function () {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    
                    eyeOpen.classList.toggle('d-none');
                    eyeClosed.classList.toggle('d-none');
                });
            }
            

            const animatedElements = document.querySelectorAll('.animate-on-load');
            setTimeout(() => {
                animatedElements.forEach(el => {
                    el.classList.add('is-visible');
                });
            }, 100);
        });
    </script>
</body>
</html>