@extends('layouts.app')

@section('content')
<style>
    body {

        min-height: 100vh;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.88);
        box-shadow: 0 10px 36px 0 rgba(163, 112, 239, 0.12), 0 2px 4px 0 rgba(56,182,255,0.09);
        border-radius: 2.5rem;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(163,112,239,0.13);
        animation: fadeGlass 1.2s cubic-bezier(.39,.575,.56,1) both;
    }
    @keyframes fadeGlass {
        0% { opacity: 0; transform: translateY(-70px) scale(.98);}
        100% { opacity: 1; transform: translateY(0) scale(1);}
    }
    .glass-header {
       background: linear-gradient(90deg, #a770ef 20%, #38b6ff 100%);
        color: #fff;
        border-radius: 2.5rem 2.5rem 0 0;
        font-size: 1.7rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-align: center;
        padding: 1.4rem 0 1.1rem 0;
        box-shadow: 0 4px 10px rgba(56,182,255,0.08);
        border-bottom: 1.5px solid #fff5;
    }
    .form-label {
        font-weight: 600;
        color: #8d38ff;
        letter-spacing: .5px;
    }
    .btn-modern {
        background: linear-gradient(90deg, #a770ef 20%, #38b6ff 100%);
        border: none;
        color: #fff;
        border-radius: 2rem;
        font-size: 1.15rem;
        font-weight: bold;
        letter-spacing: 1px;
        padding: 0.7rem 2.2rem;
        box-shadow: 0 2px 10px 0 rgba(163,112,239,0.15);
        transition: background 0.18s, transform 0.13s;
    }
    .btn-modern:hover {
        background: linear-gradient(90deg, #38b6ff 10%, #a770ef 90%);
        transform: translateY(-2px) scale(1.035);
    }
    .form-control:focus {
        border-color: #a770ef;
        box-shadow: 0 0 0 0.13rem #a770ef40;
    }
    .form-hint {
        font-size: 0.92rem;
        color: #b5b5c3;
        margin-top: 2px;
        margin-bottom: 0;
    }
    @media (max-width: 767px) {
        .row-cols-md-2 > * {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
<div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="col-md-10 col-lg-12">
        <div class="glass-card p-4">
            <div class="glass-header mb-4">
                إنشاء حساب مستخدم جديد
            </div>
            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf
                <!-- صف الحقول الأول -->
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    <!-- الاسم الكامل -->
                    <div>
                        <label for="name" class="form-label">الاسم الكامل</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autofocus>
                        <div class="form-hint">يرجى إدخال اسمك الحقيقي.</div>
                        @error('name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <!-- رقم الهاتف -->
                    <div>
                        <label for="phone" class="form-label">رقم الهاتف</label>
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                            name="phone" value="{{ old('phone') }}" required>
                        <div class="form-hint">مثال: 09xxxxxxxx</div>
                        @error('phone')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <!-- العنوان -->
                    <div>
                        <label for="address" class="form-label">العنوان</label>
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                            name="address" value="{{ old('address') }}" required>
                        <div class="form-hint">مثال: طرابلس - باب بن غشير</div>
                        @error('address')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <!-- رابط جوجل ماب -->
                    <div>
                        <label for="map_link" class="form-label">رابط جوجل ماب <span class="text-muted">(اختياري)</span></label>
                        <input id="map_link" type="url" class="form-control @error('map_link') is-invalid @enderror"
                            name="map_link" value="{{ old('map_link') }}">
                        <div class="form-hint">انسخ الرابط من Google Maps إذا وُجد</div>
                        @error('map_link')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <!-- اسم الوحدة الصحية -->
                    <div>
                        <label for="health_unit" class="form-label">اسم الوحدة الصحية</label>
                        <input id="health_unit" type="text" class="form-control @error('health_unit') is-invalid @enderror"
                            name="health_unit" value="{{ old('health_unit') }}" required>
                        <div class="form-hint">أدخل اسم الوحدة الصحية أو المستشفى</div>
                        @error('health_unit')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <!-- البريد الإلكتروني -->
                    <div>
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <!-- كلمة المرور -->
                    <div>
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required>
                        <div class="form-hint">يجب أن لا تقل عن 8 أحرف أو أرقام</div>
                        @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <!-- تأكيد كلمة المرور -->
                    <div>
                        <label for="password-confirm" class="form-label">تأكيد كلمة المرور</label>
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-modern w-50">
                        <i class="bi bi-person-plus-fill me-2"></i> تسجيل
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
