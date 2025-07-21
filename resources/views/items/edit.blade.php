@extends('layouts.app')

@section('content')
<div class="container" style="max-width:600px;">
    <div class="card shadow rounded-4 mt-5">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h3 class="mb-0"><i class="bi bi-pencil-square me-2"></i>تعديل بيانات المنتج</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('items.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- بيانات المنتج الأساسية -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold"><i class="bi bi-box-seam me-1"></i>اسم المنتج</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold"><i class="bi bi-card-text me-1"></i>وصف المنتج</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $item->description }}</textarea>
                </div>
                <!-- ربط القسم الفرعي -->
                <div class="mb-3">
                    <label for="sub_category_id" class="form-label fw-bold"><i class="bi bi-list-ul me-1"></i>القسم الفرعي</label>
                    <select class="form-select" id="sub_category_id" name="sub_category_id" required>
                        <option value="">اختر القسم الفرعي</option>
                        @foreach($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}" {{ $item->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- بيانات infos -->
                <div class="mb-3">
                    <label for="quantity" class="form-label fw-bold"><i class="bi bi-123 me-1"></i>عدد المنتج</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $info ? $info->quantity : '' }}" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="expire_date" class="form-label fw-bold"><i class="bi bi-calendar-date me-1"></i>تاريخ الصلاحية</label>
                    <input type="date" class="form-control" id="expire_date" name="expire_date" value="{{ $info ? $info->expire_date : '' }}">
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill">
                        <i class="bi bi-check2-circle me-1"></i>تحديث البيانات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
