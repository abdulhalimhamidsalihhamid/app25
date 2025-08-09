@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-center text-danger">
        <i class="bi bi-x-circle"></i> المنتجات منتهية الصلاحية
    </h3>

    @if($expiredItems->count() > 0)
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>اسم المنتج</th>
                    <th>الكمية</th>
                    <th>تاريخ الصلاحية</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expiredItems as $expired)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $expired->item->name ?? '—' }}</td>
                        <td>{{ $expired->quantity }}</td>
                        <td>{{ $expired->expire_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted text-center">لا توجد منتجات منتهية الصلاحية حالياً.</p>
    @endif
</div>
@endsection
