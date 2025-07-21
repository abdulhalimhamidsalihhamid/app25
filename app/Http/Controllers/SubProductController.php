<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Http\Request;

class SubProductController extends Controller
{
    public function create()
    {
        $products = Product::all();
        $subproducts = SubProduct::with('parent')->get();
        return view('subproducts.create', compact('products', 'subproducts'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        SubProduct::create($validated);

        return redirect()->route('subproducts.create')->with('status', 'تمت إضافة الصنف الفرعي بنجاح');
    }

    public function destroy($id)
    {
        $subProduct = SubProduct::findOrFail($id);
        $subProduct->delete();

        return redirect()->route('subproducts.create')->with('status', 'تم حذف الصنف الفرعي بنجاح');
    }

    public function edit($id)
    {
        $subproduct = SubProduct::findOrFail($id);
        $products = Product::all(); // جميع الأصناف الأب
        return view('subproducts.edit', compact('subproduct', 'products'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $subproduct = SubProduct::findOrFail($id);
        $subproduct->update($validated);

        return redirect()->route('subproducts.create')->with('status', 'تم تعديل الصنف الفرعي بنجاح');
    }
}
