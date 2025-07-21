@extends('layouts.app')

@section('content')
<div class="container" style="max-width:900px">
    <h2 class="mb-4 text-center fw-bold text-primary">قائمة الطلبيات</h2>
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- زر إضافة طلبية جديدة أعلى الصفحة --}}
    <div class="mb-4 text-end">
        <a href="{{ route('orders.create') }}" class="btn btn-success btn-lg shadow-sm">
            <i class="bi bi-plus-circle"></i> إضافة طلبية جديدة
        </a>
    </div>

    @forelse($orders as $order)
        <div class="card mb-4 shadow rounded-4 border-2 border-primary">
            <div class="card-header bg-gradient bg-primary text-white rounded-top-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-receipt"></i> <b>طلبية رقم #{{ $order->id }}</b></span>
                    <span class="small"><i class="bi bi-calendar-date"></i> {{ $order->order_date }}</span>
                </div>
            </div>
            <div class="card-body" style="background: #f9fafb">
                {{-- تجميع المنتجات حسب التصنيف الرئيسي ثم الفرعي --}}
                @php
                    $grouped = [];
                    foreach($order->orderItems as $orderItem) {
                        $item = $orderItem->item;
                        $main = $item->subProduct->productCategory->name ?? 'بدون تصنيف رئيسي';
                        $sub = $item->subProduct->name ?? 'بدون صنف فرعي';
                        $grouped[$main][$sub][] = [
                            'name' => $item->name,
                            'quantity' => $orderItem->quantity,
                        ];
                    }
                    // فحص إذا تم إرسال الطلبية (موجودة في جدول health_unit_orders)
                    $healthUnitOrder = \App\Models\HealthUnitOrder::where('order_id', $order->id)->latest()->first();
                    $isSent = !!$healthUnitOrder;
                    $status = $healthUnitOrder->status ?? null;
                @endphp

                @foreach($grouped as $mainCat => $subs)
                    <div class="mb-2 mt-3">
                        <div class="fw-bold text-success" style="font-size:1.15rem;">
                            <i class="bi bi-diagram-3"></i> {{ $mainCat }}
                        </div>
                        @foreach($subs as $subCat => $items)
                            <div class="ms-4 mb-2">
                                <span class="fw-bold text-primary" style="font-size:1rem;">
                                    <i class="bi bi-box"></i> {{ $subCat }}
                                </span>
                                <table class="table table-bordered table-sm mt-2 mb-2" style="background:#fff;">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width:60%">اسم المنتج</th>
                                            <th>الكمية</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $prod)
                                        <tr>
                                            <td>{{ $prod['name'] }}</td>
                                            <td class="text-center">{{ $prod['quantity'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                        <hr>
                    </div>
                @endforeach

                {{-- أزرار التعديل والحذف وزر إرسال الطلبية أو شارة الحالة --}}
                @if(!$isSent)
                    <div class="d-flex justify-content-end gap-2 mt-2 flex-wrap">
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> تعديل
                        </a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف الطلبية؟');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> حذف
                            </button>
                        </form>
                        <form action="{{ route('orders.send', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bi bi-send"></i> إرسال الطلبية
                            </button>
                        </form>
                    </div>
                @else
                    <div class="text-end mt-2">
                        @if($status == 'قيد التجهيز')
                            <span class="badge bg-warning text-dark" style="font-size:1rem;">
                                <i class="bi bi-hourglass-split"></i> {{ $status }}
                            </span>
                        @elseif($status == 'قيد التوصيل')
                            <span class="badge bg-info text-dark" style="font-size:1rem;">
                                <i class="bi bi-truck"></i> {{ $status }}
                            </span>
                        @elseif($status == 'تم الاستلام')
                            <span class="badge bg-success" style="font-size:1rem;">
                                <i class="bi bi-check-circle"></i> {{ $status }}
                            </span>
                        @elseif($status == 'مرفوضة')
                            <span class="badge bg-danger" style="font-size:1rem;">
                                <i class="bi bi-x-octagon"></i> {{ $status }}
                            </span>
                        @else
                            <span class="badge bg-secondary" style="font-size:1rem;">
                                {{ $status }}
                            </span>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center mt-4">لا توجد طلبيات.</div>
    @endforelse

    {{-- زر إضافة طلبية جديدة أسفل الصفحة --}}
    <div class="mt-5 text-center">
        <a href="{{ route('orders.create') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="bi bi-plus-circle"></i> إضافة طلبية جديدة
        </a>
    </div>
</div>

{{-- Bootstrap Icons CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
