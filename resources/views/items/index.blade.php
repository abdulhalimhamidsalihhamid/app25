@extends('layouts.app')

@section('content')
<style>
    .table-main {
        background: #fff;
        border-radius: 1.5rem;
        border: 2px solid #03543f;
        box-shadow: 0 2px 16px 0 #02856422;
        padding: 1.5rem 1.7rem;
        margin-top: 2.5rem;
        margin-bottom: 2.5rem;
    }
    .btn-main {
        background: linear-gradient(90deg, #04866a 20%, #02513e 100%);
        color: #fff;
        border: none;
        border-radius: 1.2rem;
        padding: 0.3rem 1.2rem;
        font-size: 1rem;
        font-weight: bold;
        letter-spacing: .6px;
        transition: background 0.18s, transform 0.13s;
        box-shadow: 0 2px 10px 0 #04866a19;
        margin-right: 3px;
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
</style>
<div class="container">
    <div class="table-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 style="font-weight: 800; color: #03543f;">قائمة المنتجات</h4>
            <a href="{{ route('items.create') }}" class="btn btn-main">
                <i class="bi bi-plus-circle"></i> إضافة منتج جديد
            </a>
        </div>
        @if(session('status'))
            <div class="alert alert-success text-center mb-3">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-bordered text-center align-middle">
            <thead class="table-success" style="font-weight:700;">
                <tr>
                    <th>#</th>
                    <th>اسم المنتج</th>
                    <th>وصف المنتج</th>
                    <th>العدد</th>
                    <th>تاريخ الصلاحية</th>
                    <th>التحكم</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            {{-- أول معلومة للمنتج --}}
                            {{ optional($item->infos->first())->quantity ?? '-' }}
                        </td>
                        <td>
                            {{ optional($item->infos->first())->expire_date ?? '-' }}
                        </td>
                        <td>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-main" title="تعديل">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
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
                        <td colspan="6" class="text-muted">لا توجد منتجات حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
