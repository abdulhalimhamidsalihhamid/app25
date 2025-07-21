@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">تعديل صنف فرعي</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('subproducts.update', $subproduct->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم الصنف الفرعي</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   required value="{{ old('name', $subproduct->name) }}">
                            @error('name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product_id" class="form-label">الصنف الأب</label>
                            <select id="product_id" name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                                <option value="">-- اختر الصنف الأب --</option>
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}" @if(old('product_id', $subproduct->product_id) == $prod->id) selected @endif>
                                        {{ $prod->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">تفاصيل الصنف الفرعي</label>
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                                      rows="4">{{ old('description', $subproduct->description) }}</textarea>
                            @error('description')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success w-50" type="submit">
                                <i class="bi bi-check-circle"></i> حفظ التعديلات
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-4">
                        <a href="{{ route('subproducts.create') }}" class="btn btn-link" style="color:#03543f;font-weight:600">
                            <i class="bi bi-arrow-bar-left"></i> العودة للأصناف الفرعية
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
