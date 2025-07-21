@extends('layouts.app')

@section('content')
<div class="container" style="max-width:600px">
    <h2 class="my-4 text-center fw-bold text-primary">تعديل الحساب الشخصي</h2>
    @if(session('status'))
        <div class="alert alert-success text-center mb-3">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required>
            @error('name')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">رقم الجوال</label>
            <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', $user->phone) }}">
            @error('phone')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">العنوان</label>
            <input id="address" name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                   value="{{ old('address', $user->address) }}">
            @error('address')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="health_unit" class="form-label">الوحدة الصحية</label>
            <input id="health_unit" name="health_unit" type="text" class="form-control @error('health_unit') is-invalid @enderror"
                   value="{{ old('health_unit', $user->health_unit) }}">
            @error('health_unit')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="map_link" class="form-label">رابط الخريطة</label>
            <input id="map_link" name="map_link" type="url" class="form-control @error('map_link') is-invalid @enderror"
                   value="{{ old('map_link', $user->map_link) }}">
            @error('map_link')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور الجديدة (اختياري)</label>
            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
        </div>
        <div class="text-center">
            <button class="btn btn-success w-50" type="submit">
                <i class="bi bi-save"></i> حفظ التغييرات
            </button>
        </div>
    </form>
</div>
@endsection
