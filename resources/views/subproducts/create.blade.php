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
    .btn-danger {
        background: #d32f2f !important;
        color: #fff !important;
        border-radius: 1.2rem;
        padding: 0.3rem 1.2rem;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        margin-right: 3px;
    }
    .btn-danger:hover {
        background: #b71c1c !important;
    }
    .table-main {
        background: #fff;
        border-radius: 1.5rem;
        border: 2px solid #03543f;
        box-shadow: 0 2px 16px 0 #02856422;
        padding: 1.5rem 1.7rem;
        margin-bottom: 2.5rem;
        margin-top: 2rem;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="custom-card">
                <div class="custom-header">
                    إضافة صنف فرعي جديد
                </div>
                @if(session('status'))
                    <div class="alert alert-success text-center mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('subproducts.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم الصنف الفرعي</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="product_id" class="form-label">الصنف الأب</label>
                        <select id="product_id" name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                            <option value="">-- اختر الصنف الأب --</option>
                            @foreach($products as $prod)
                                <option value="{{ $prod->id }}" @if(old('product_id') == $prod->id) selected @endif>
                                    {{ $prod->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">تفاصيل الصنف الفرعي</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn btn-main w-50" type="submit">
                            <i class="bi bi-plus-circle"></i> إضافة الصنف الفرعي
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

    <!-- جدول الأصناف الفرعية المضافة -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="table-main">
                <h5 class="mb-3" style="font-weight:800; color:#03543f;">جميع الأصناف الفرعية</h5>
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-success" style="font-weight:700;">
                        <tr>
                            <th>#</th>
                            <th>اسم الصنف الفرعي</th>
                            <th>الصنف الأب</th>
                            <th>تفاصيل</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subproducts as $sub)
                            <tr>
                                <td>{{ $sub->id }}</td>
                                <td>{{ $sub->name }}</td>
                                <td>{{ $sub->parent ? $sub->parent->name : '-' }}</td>
                                <td>{{ $sub->description }}</td>
                                <td>
                                    <a href="{{ route('subproducts.edit', $sub->id) }}" class="btn btn-main" title="تعديل">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('subproducts.destroy', $sub->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="حذف">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">لا توجد أصناف فرعية حتى الآن.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
