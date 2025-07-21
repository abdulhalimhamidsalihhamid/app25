@extends('layouts.app')

@section('content')
<style>
    .category-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }
    .category-list li {
        margin-bottom: 11px;
        font-size: 1.16rem;
        color: #03543f;
        position: relative;
        padding: 10px 18px;
        border-bottom: 1px solid #e2eaf0;
        background: #f9fff7;
        border-radius: .7rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .category-title {
        font-weight: 700;
        color: #02513e;
    }
    .category-actions a, .category-actions form {
        display: inline-block;
        margin-left: 9px;
    }
    .category-actions a {
        color: #09996a;
        text-decoration: none;
        font-size: 1.13em;
        transition: color 0.13s;
        margin-left: 6px;
    }
    .category-actions a:hover {
        color: #03543f;
    }
    .category-actions button {
        background: none;
        border: none;
        color: #c21f1f;
        padding: 0 6px;
        font-size: 1.17em;
        cursor: pointer;
    }
</style>
<div class="container py-4">
    <h2 class="mb-4 text-center text-success" style="font-weight:800">قائمة الأصناف الرئيسية</h2>
    @if(session('status'))
        <div class="alert alert-success text-center mb-4">
            {{ session('status') }}
        </div>
    @endif
    <div class="mb-4 text-end">
        <a href="{{ route('products.create') }}" class="btn btn-success" style="border-radius:1.2rem;">
            <i class="bi bi-plus-circle"></i> إضافة صنف جديد
        </a>
    </div>
    <ul class="category-list">
        @forelse($rootProducts as $product)
            <li>
                <span class="category-title">{{ $product->name }}</span>
                <span class="category-actions">
                    <a href="{{ route('products.edit', $product->id) }}" title="تعديل"> <i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="حذف"><i class="bi bi-trash"></i></button>
                    </form>
                </span>
            </li>
        @empty
            <li><span style="color:#888;">لا توجد أصناف حتى الآن.</span></li>
        @endforelse
    </ul>
</div>
@endsection
