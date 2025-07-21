<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض شجرة الأصناف
    public function index()
    {
        // جلب الأصناف الجذرية مع كل الفروع (children)
        $rootProducts = Product::get();
        return view('products.index', compact('rootProducts'));
    }

    // نموذج إضافة صنف جديد
    public function create()
    {
        // جميع الأصناف لاستخدامها كأب (اختياري)
        $products = Product::all();
        return view('products.create', compact('products'));
    }

    // حفظ الصنف الجديد في قاعدة البيانات
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('status', 'تمت إضافة الصنف بنجاح');
    }

    // (اختياري) عرض تفاصيل صنف معيّن
    public function show($id)
    {
        $product = Product::with('parent', 'children')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')->with('status', 'تم تعديل الصنف بنجاح');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('status', 'تم حذف الصنف بنجاح');
    }
}
