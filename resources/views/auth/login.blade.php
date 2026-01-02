<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Karang Taruna') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow: hidden;
            position: relative;
            min-height: 100vh;
        }

        /* Background with Image */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .animated-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .animated-bg::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.7) 0%, rgba(13, 148, 136, 0.7) 100%);
            z-index: 1;
        }

        /* Container */
        .login-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Login Card */
        .glass-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        /* Logo and Header */
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-container {
            width: 70px;
            height: 70px;
            margin: 0 auto 16px;
            background: #3b82f6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-container svg,
        .logo-container img {
            width: 40px;
            height: 40px;
            filter: brightness(0) invert(1);
        }

        h1 {
            color: #1f2937;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 14px;
            font-weight: 400;
        }

        /* Alert Messages */
        .alert {
            margin-bottom: 20px;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 14px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(72, 187, 120, 0.25);
            border: 1px solid rgba(72, 187, 120, 0.4);
            color: white;
        }

        .alert-danger {
            background: rgba(245, 101, 101, 0.25);
            border: 1px solid rgba(245, 101, 101, 0.4);
            color: white;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 8px;
            color: #1f2937;
            font-size: 14px;
            transition: all 0.2s ease;
            outline: none;
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #9ca3af;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Checkbox */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin-right: 8px;
        }

        .checkbox-label span {
            color: #374151;
            font-size: 14px;
        }

        .forgot-link {
            color: #3b82f6;
            font-size: 14px;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #3b82f6;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .submit-btn:hover {
            background: #2563eb;
        }

        .submit-btn:active {
            background: #1d4ed8;
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .glass-card {
                padding: 40px 30px;
            }

            h1 {
                font-size: 28px;
            }

            .logo-container {
                width: 70px;
                height: 70px;
            }
        }

        /* Loading Animation */
        .loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Background -->
    <?php
        // Select random Karang Taruna image (1-8)
        $randomImage = 'images/homepage/karang-taruna-' . rand(1, 8) . '.jpeg';
    ?>
    <div class="animated-bg">
        <img src="{{ asset('<?php echo $randomImage; ?>') }}" alt="Karang Taruna PREGAS">
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="glass-card">
            <!-- Header -->
            <div class="login-header">
                <div class="logo-container">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1>Karang Taruna PREGAS</h1>
                <p class="subtitle">Persatuan Remaja Gandul Selatan</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="nama@email.com"
                            required 
                            autofocus
                        >
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            required 
                            autocomplete="current-password"
                        >
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="checkbox-wrapper">
                    <label class="checkbox-label">
                        <input type="checkbox" id="remember_me" name="remember">
                        <span>Ingat Saya</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    Masuk
                </button>
            </form>
        </div>
    </div>

    <script>
        // Add loading animation on form submit
        const form = document.getElementById('loginForm');
        const submitBtn = form.querySelector('.submit-btn');
        
        form.addEventListener('submit', function() {
            submitBtn.classList.add('loading');
            submitBtn.textContent = 'Memproses...';
        });

        // Add focus animation to inputs
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
