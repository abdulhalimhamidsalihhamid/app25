@extends('layouts.app')

@section('content')
<div class="container" style="max-width:900px">
    <h2 class="my-4 text-center fw-bold text-primary">إحصائيات المخزن</h2>
    <div class="row g-4 justify-content-center">

        <div class="col-md-4">
            <div class="card shadow text-center border-primary">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3"><i class="bi bi-box-seam"></i> إجمالي المنتجات</h5>
                    <h2>{{ $totalItems }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center border-success">
                <div class="card-body">
                    <h5 class="card-title text-success mb-3"><i class="bi bi-archive"></i> إجمالي الكمية المخزنة</h5>
                    <h2>{{ $totalQuantity }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center border-info">
                <div class="card-body">
                    <h5 class="card-title text-info mb-3"><i class="bi bi-list-columns"></i> الأصناف الرئيسية</h5>
                    <h2>{{ $totalCategories }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning mb-3"><i class="bi bi-tags"></i> الأصناف الفرعية</h5>
                    <h2>{{ $totalSubCategories }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center border-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger mb-3"><i class="bi bi-x-circle"></i> منتهية الصلاحية</h5>
                    <h2>{{ $expiredItems }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow text-center border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning mb-3"><i class="bi bi-alarm"></i> ستنتهي خلال 30 يوم</h5>
                    <h2>{{ $nearExpiredItems }}</h2>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Bootstrap Icons CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
