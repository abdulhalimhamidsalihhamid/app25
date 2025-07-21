@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 900px;">
    <div class="card mt-5 mb-5 shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">تعديل طلبية رقم #{{ $order->id }}</h4>
        </div>
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('orders.update', $order->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="order_date" class="form-label">تاريخ الطلبية</label>
                    <input type="date" name="order_date" id="order_date" class="form-control" value="{{ old('order_date', $order->order_date) }}" required>
                </div>
                <hr>
                <h5 class="mb-3">المنتجات المطلوبة:</h5>
                <div id="order-items-list">
                    @foreach($order->orderItems as $idx => $orderItem)
                        @php
                            $selectedProduct = $orderItem->item->subProduct->productCategory ?? null;
                            $selectedSubProduct = $orderItem->item->subProduct ?? null;
                        @endphp
                        <div class="row g-2 mb-2 order-item-row">
                            <div class="col-md-4">
                                <select class="form-select main-product" required>
                                    <option value="">اختر التصنيف الرئيسي</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $selectedProduct && $product->id == $selectedProduct->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select sub-product" required>
                                    <option value="">اختر القسم الفرعي</option>
                                    @if($selectedProduct)
                                        @foreach($selectedProduct->subProducts as $sub)
                                            <option value="{{ $sub->id }}" {{ $selectedSubProduct && $sub->id == $selectedSubProduct->id ? 'selected' : '' }}>
                                                {{ $sub->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="items[{{ $idx }}][item_id]" class="form-select item-select" required>
                                    <option value="">اختر المنتج</option>
                                    @if($selectedSubProduct)
                                        @foreach($selectedSubProduct->items as $item)
                                            <option value="{{ $item->id }}" {{ $orderItem->item->id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-1">
                                <input type="number" name="items[{{ $idx }}][quantity]" class="form-control" min="1" value="{{ $orderItem->quantity }}" required>
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <button type="button" class="btn btn-danger btn-remove-item" onclick="removeOrderItem(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary mb-3" onclick="addOrderItem()">
                    <i class="bi bi-plus-circle"></i> إضافة منتج آخر
                </button>
                <div class="text-center">
                    <button type="submit" class="btn btn-warning px-5">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Bootstrap Icons CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script>
let products = @json($products);
let itemIndex = {{ count($order->orderItems) }};

// تعبئة الأقسام الفرعية والمنتجات عند إضافة صف جديد
function fillSubProducts(row, productId) {
    let subProducts = [];
    products.forEach(product => {
        if (product.id == productId) subProducts = product.sub_products;
    });
    let subProductSelect = row.querySelector('.sub-product');
    let itemSelect = row.querySelector('.item-select');
    subProductSelect.innerHTML = '<option value="">اختر القسم الفرعي</option>';
    itemSelect.innerHTML = '<option value="">اختر المنتج</option>';
    if (subProducts && subProducts.length > 0) {
        subProductSelect.disabled = false;
        subProducts.forEach(sub => {
            subProductSelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
        });
    } else {
        subProductSelect.disabled = true;
    }
    itemSelect.disabled = true;
}

function fillItems(row, subProductId) {
    let items = [];
    products.forEach(product => {
        product.sub_products.forEach(sub => {
            if (sub.id == subProductId) items = sub.items;
        });
    });
    let itemSelect = row.querySelector('.item-select');
    itemSelect.innerHTML = '<option value="">اختر المنتج</option>';
    if (items && items.length > 0) {
        itemSelect.disabled = false;
        items.forEach(item => {
            itemSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
        });
    } else {
        itemSelect.disabled = true;
    }
}

document.addEventListener('change', function(e){
    if(e.target.classList.contains('main-product')){
        let row = e.target.closest('.order-item-row');
        fillSubProducts(row, e.target.value);
        // عند تغيير التصنيف الرئيسي، أفرغ القيم القديمة
        row.querySelector('.sub-product').selectedIndex = 0;
        row.querySelector('.item-select').selectedIndex = 0;
    }
    if(e.target.classList.contains('sub-product')){
        let row = e.target.closest('.order-item-row');
        fillItems(row, e.target.value);
        // عند تغيير القسم الفرعي، أفرغ قيمة المنتج
        row.querySelector('.item-select').selectedIndex = 0;
    }
});

function addOrderItem() {
    let html = `
    <div class="row g-2 mb-2 order-item-row">
        <div class="col-md-4">
            <select class="form-select main-product" required>
                <option value="">اختر التصنيف الرئيسي</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select sub-product" required disabled>
                <option value="">اختر القسم الفرعي</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="items[${itemIndex}][item_id]" class="form-select item-select" required disabled>
                <option value="">اختر المنتج</option>
            </select>
        </div>
        <div class="col-md-1">
            <input type="number" name="items[${itemIndex}][quantity]" class="form-control" min="1" value="1" required>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <button type="button" class="btn btn-danger btn-remove-item" onclick="removeOrderItem(this)">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>`;
    document.getElementById('order-items-list').insertAdjacentHTML('beforeend', html);
    itemIndex++;
}

function removeOrderItem(btn) {
    let row = btn.closest('.order-item-row');
    if(document.querySelectorAll('.order-item-row').length > 1) {
        row.remove();
    }
}
</script>
@endsection
