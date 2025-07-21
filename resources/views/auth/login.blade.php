@extends('layouts.app')

@section('content')
<style>
    body {
        background: #fff !important; /* خلفية بيضاء صافية */
        min-height: 100vh;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 10px 36px 0 rgba(0,204,153,0.09), 0 2px 4px 0 rgba(0,204,153,0.07);
        border-radius: 2.5rem;
        backdrop-filter: blur(11px);
        border: 2px solid #e8fff3;
        animation: fadeGlass 1.1s cubic-bezier(.39,.575,.56,1) both;
    }
    @keyframes fadeGlass {
        0% { opacity: 0; transform: translateY(-70px) scale(.98);}
        100% { opacity: 1; transform: translateY(0) scale(1);}
    }
    .glass-header {
        background: linear-gradient(90deg, #00cc99 0%, #2ee59d 60%, #09996a 100%);
        color: #fff;
        border-radius: 2.5rem 2.5rem 0 0;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-align: center;
        padding: 1.1rem 0 1rem 0;
        box-shadow: 0 4px 10px rgba(0,204,153,0.07);
        border-bottom: 1.5px solid #e6fff5;
    }
    .form-label {
        font-weight: 600;
        color: #09996a;
        letter-spacing: .5px;
    }
    .btn-modern {
        background: linear-gradient(90deg, #09996a 40%, #09996a 100%);
        border: none;
        color: #fff;
        border-radius: 2rem;
        font-size: 1.10rem;
        font-weight: bold;
        letter-spacing: 1px;
        padding: 0.65rem 2.2rem;
        box-shadow: 0 2px 10px 0 rgba(0,204,153,0.11);
        transition: background 0.18s, transform 0.13s;
    }
    .btn-modern:hover {
        background: linear-gradient(90deg, #09996a 20%, #09996a 80%);
        transform: translateY(-2px) scale(1.03);
    }
    .form-control:focus {
        border-color: #00cc99;
        box-shadow: 0 0 0 0.13rem #00cc9955;
    }
    .form-check-label {
        color: #09996a;
        font-size: .98rem;
        margin-right: .6rem;
    }
</style>
<div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="col-md-8 col-lg-8">
        <div class="glass-card p-4">
            <div class="glass-header mb-4">
                تسجيل الدخول إلى حسابك
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- البريد الإلكتروني -->
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <!-- كلمة المرور -->
                <div class="mb-3">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3 form-check text-end pe-2">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        تذكرني
                    </label>
                </div>
                <div class="text-center mb-2">
                    <button type="submit" class="btn btn-modern w-75">
                        <i class="bi bi-box-arrow-in-right me-2"></i> دخول
                    </button>
                </div>
                <div class="text-center">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}" style="color:#09996a;">
                            هل نسيت كلمة المرور؟
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
