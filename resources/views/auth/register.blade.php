@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&display=swap');
    
    body {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    .register-container {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(10px);
        overflow: hidden;
        margin-top: 2rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .register-header {
        background: linear-gradient(45deg, #a8d8ea, #aa96da);
        color: #2c3e50;
        text-align: center;
        padding: 2rem;
        position: relative;
    }
    
    .register-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="70" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="70" cy="80" r="2.5" fill="rgba(255,255,255,0.1)"/></svg>');
        animation: float 20s infinite linear;
    }
    
    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        100% { transform: translate(-50px, -50px) rotate(360deg); }
    }
    
    .posyandu-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }
    
    .register-title {
        font-size: 1.8rem;
        font-weight: 600;
        margin: 0;
        position: relative;
        z-index: 1;
        letter-spacing: -0.5px;
    }
    
    .register-subtitle {
        font-size: 1rem;
        font-weight: 400;
        opacity: 0.9;
        margin-top: 0.5rem;
        position: relative;
        z-index: 1;
        letter-spacing: 0.2px;
    }
    
    .form-container {
        padding: 2.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-label {
        font-weight: 500;
        color: #555;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        letter-spacing: 0.3px;
    }
    
    .form-control {
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        font-weight: 400;
        transition: all 0.3s ease;
        background: #fafbfc;
        letter-spacing: 0.2px;
    }
    
    .form-control:focus {
        border-color: #a8d8ea;
        box-shadow: 0 0 0 3px rgba(168, 216, 234, 0.2);
        background: white;
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    
    .invalid-feedback {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #dc3545;
    }
    
    .btn-register {
        background: linear-gradient(45deg, #a8d8ea, #aa96da);
        border: none;
        border-radius: 12px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        font-size: 1rem;
        color: #2c3e50;
        width: 100%;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        letter-spacing: 0.5px;
    }
    
    .btn-register::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .btn-register:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(168, 216, 234, 0.3);
    }
    
    .welcome-text {
        text-align: center;
        margin-bottom: 2rem;
        color: #666;
    }
    
    .welcome-text h5 {
        font-weight: 500;
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        letter-spacing: -0.3px;
    }
    
    .welcome-text p {
        font-weight: 400;
        font-size: 0.95rem;
        opacity: 0.8;
        letter-spacing: 0.2px;
        line-height: 1.5;
    }
    
    .icon-name::before {
        content: "👤";
        margin-right: 0.5rem;
    }
    
    .icon-email::before {
        content: "📧";
        margin-right: 0.5rem;
    }
    
    .icon-password::before {
        content: "🔒";
        margin-right: 0.5rem;
    }
    
    .icon-confirm::before {
        content: "🔐";
        margin-right: 0.5rem;
    }
    
    .decorative-elements {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        overflow: hidden;
    }
    
    .decorative-elements::before,
    .decorative-elements::after {
        content: '';
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(168, 216, 234, 0.1);
    }
    
    .decorative-elements::before {
        top: -50px;
        right: -50px;
        animation: pulse 4s infinite;
    }
    
    .decorative-elements::after {
        bottom: -50px;
        left: -50px;
        animation: pulse 4s infinite 2s;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 0.3; }
    }
    
    .login-link {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e9ecef;
    }
    
    .login-link a {
        color: #6c757d;
        text-decoration: none;
        font-weight: 400;
        letter-spacing: 0.2px;
        transition: all 0.3s ease;
    }
    
    .login-link a:hover {
        color: #495057;
        text-decoration: none;
    }
    
    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }
        
        .register-header {
            padding: 1.5rem;
        }
        
        .posyandu-icon {
            font-size: 2.5rem;
        }
        
        .register-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="register-container">
                <div class="decorative-elements"></div>
                
                <div class="register-header">
                    <div class="posyandu-icon">👶</div>
                    <h1 class="register-title">Daftar Akun Baru</h1>
                    <p class="register-subtitle">Bergabunglah dengan Sistem Posyandu Balita</p>
                </div>

                <div class="form-container">
                    <div class="welcome-text">
                        <h5>Selamat Datang!</h5>
                        <p>Silakan lengkapi data berikut untuk membuat akun baru</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-label icon-name">{{ __('Name') }}</label>
                            <input id="name" 
                                   type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autocomplete="name" 
                                   autofocus
                                   placeholder="Masukkan nama lengkap Anda">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label icon-email">{{ __('Email Address') }}</label>
                            <input id="email" 
                                   type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email"
                                   placeholder="Masukkan alamat email Anda">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label icon-password">{{ __('Password') }}</label>
                            <input id="password" 
                                   type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Buat password yang kuat">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="form-label icon-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" 
                                   type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Ulangi password Anda">
                        </div>

                        <button type="submit" class="btn-register">
                            <span>{{ __('Register') }}</span>
                        </button>
                    </form>
                    
                    <div class="login-link">
                        <p>Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection