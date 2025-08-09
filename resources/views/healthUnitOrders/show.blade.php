@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-center">تفاصيل الطلبية</h3>

    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>اسم المنتج</th>
                <th>الكمية</th>
               
            </tr>
        </thead>
        <tbody>
            @forelse($order->orderItems ?? [] as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->item->name ?? 'غير متوفر' }}</td>
                    <td>
                        {{ $item->item->infos->first()->quantity ?? '—' }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4">لا توجد منتجات في هذه الطلبية</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="{{ route('healthUnitOrders.index') }}" class="btn btn-secondary">عودة للقائمة</a>
    </div>
</div>
@endsection
