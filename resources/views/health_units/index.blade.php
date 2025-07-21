@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4 text-center">جدول طلبيات الوحدات الصحية</h3>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>معرف الطلبية</th>
                    <th>العنوان علي الخريطة </th>
                    <th>اسم المستخدم</th>
                    <th>حالة الطلبية</th>
                    <th>تاريخ الإضافة</th>
                    <th>تعديل الحالة</th>
                </tr>
            </thead>
            <tbody>
                @forelse($healthUnitOrders as $huOrder)
                    <tr>
                        <td>{{ $huOrder->id }}</td>
                        <td>{{ $huOrder->order_id }}</td>
                        <td>
                            @if ($huOrder->map_link)
                                <a href="{{ $huOrder->map_link }}" target="_blank" style="color:#04866a;">
                                    عرض على الخريطة
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $huOrder->user->name ?? '-' }}</td>
                        <td>
                            @if ($huOrder->status == 'قيد التجهيز')
                                <span class="badge bg-warning text-dark">{{ $huOrder->status }}</span>
                            @elseif($huOrder->status == 'قيد التوصيل')
                                <span class="badge bg-info text-dark">{{ $huOrder->status }}</span>
                            @elseif($huOrder->status == 'تم الاستلام')
                                <span class="badge bg-success">{{ $huOrder->status }}</span>
                            @elseif($huOrder->status == 'مرفوضة')
                                <span class="badge bg-danger">{{ $huOrder->status }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $huOrder->status }}</span>
                            @endif
                        </td>
                        <td>{{ $huOrder->created_at->format('Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('healthUnitOrders.updateStatus', $huOrder->id) }}" method="POST"
                                class="d-flex justify-content-center align-items-center gap-2">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select form-select-sm" style="width: 150px;">
                                    <option value="قيد التجهيز" {{ $huOrder->status == 'قيد التجهيز' ? 'selected' : '' }}>
                                        قيد التجهيز</option>
                                    <option value="قيد التوصيل" {{ $huOrder->status == 'قيد التوصيل' ? 'selected' : '' }}>
                                        قيد التوصيل</option>
                                    <option value="تم الاستلام" {{ $huOrder->status == 'تم الاستلام' ? 'selected' : '' }}>
                                        تم الاستلام</option>
                                    <option value="مرفوضة" {{ $huOrder->status == 'مرفوضة' ? 'selected' : '' }}>مرفوضة
                                    </option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">حفظ</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">لا توجد طلبيات.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
