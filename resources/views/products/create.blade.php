@extends('layouts.app')

@section('content')
<style>
    .custom-card {
        background: #fff;
        border-radius: 1.5rem;
        border: 2px solid #03543f;
        box-shadow: 0 2px 16px 0 #02856422;
        padding: 2.5rem 1.7rem;
        margin-top: 2.5rem;
        margin-bottom: 2.5rem;
    }
    .custom-header {
        font-size: 1.45rem;
        font-weight: 800;
        color: #03543f;
        text-align: center;
        letter-spacing: 1.5px;
        margin-bottom: 2rem;
    }
    .form-label {
        color: #04866a;
        font-weight: 600;
    }
    .btn-main {
        background: linear-gradient(90deg, #04866a 20%, #02513e 100%);
        color: #fff;
        border: none;
        border-radius: 1.2rem;
        padding: 0.65rem 2rem;
        font-size: 1.13rem;
        font-weight: bold;
        letter-spacing: .8px;
        transition: background 0.18s, transform 0.13s;
        box-shadow: 0 2px 10px 0 #04866a19;
    }
    .btn-main:hover {
        background: linear-gradient(90deg, #02513e 20%, #04866a 80%);
        transform: scale(1.03);
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="custom-card">
                <div class="custom-header">
                    إضافة صنف رئيسي جديد
                </div>
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <!-- اسم الصنف الرئيسي -->
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم الصنف الرئيسي</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <!-- تفصيل الصنف الرئيسي -->
                    <div class="mb-4">
                        <label for="description" class="form-label">تفصيل الصنف</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn btn-main w-50" type="submit">
                            <i class="bi bi-plus-circle"></i> إضافة الصنف الرئيسي
                        </button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-link" style="color:#03543f;font-weight:600">
                        <i class="bi bi-arrow-bar-left"></i> العودة لقائمة الأصناف
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
