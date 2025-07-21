<li>
    <span class="category-title">{{ $product->name }}</span>
    <span class="category-actions">
        <a href="{{ route('products.show', $product->id) }}" title="عرض"><i class="bi bi-eye"></i></a>
        <a href="{{ route('products.edit', $product->id) }}" title="تعديل"><i class="bi bi-pencil-square"></i></a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;"
            onsubmit="return confirm('هل أنت متأكد من حذف الصنف؟');">
            @csrf
            @method('DELETE')
            <button type="submit" title="حذف"
                style="border:none;background:none;color:#c21f1f;padding:0;margin:0 0 0 5px;cursor:pointer;">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </span>
    @if (isset($product->children) && $product->children->count())
        <ul>
            @foreach ($product->children as $child)
                @include('products.category_node', ['product' => $child])
            @endforeach
        </ul>
    @endif
</li>















