@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-center text-warning">
        <i class="bi bi-alarm"></i> المنتجات التي ستنتهي خلال 30 يوم
    </h3>

    @if($nearExpiredItems->count() > 0)
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
                @foreach($nearExpiredItems as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->item->name ?? '—' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->expire_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted text-center">لا توجد منتجات ستنتهي خلال 30 يوم حالياً.</p>
    @endif
</div>
@endsection
