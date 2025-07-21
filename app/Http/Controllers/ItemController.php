<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemInfo;
use App\Models\SubProduct;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // عرض جميع المنتجات
    public function index()
    {
        // جلب المنتجات مع آخر معلومات (عدد وصلاحية)
        $items = Item::with('infos')->get();
        return view('items.index', compact('items'));
    }

    // عرض نموذج إضافة منتج
public function create()
{
    $subCategories = SubProduct::all(); // جلب كل الأقسام الفرعية
    return view('items.create', compact('subCategories'));
}


    // تخزين منتج جديد مع معلوماته
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'sub_category_id' => 'required|exists:sub_products,id',
        'quantity' => 'required|integer|min:0',
        'expire_date' => 'nullable|date',
    ]);

    // إضافة المنتج
    $item = Item::create([
        'name' => $request->name,
        'description' => $request->description,
        'sub_product_id' => $request->sub_category_id,
    ]);

    // إضافة بيانات infos المرتبطة
    $item->infos()->create([
        'quantity' => $request->quantity,
        'expire_date' => $request->expire_date,
    ]);

    return redirect()->route('items.index')->with('success', 'تمت إضافة المنتج بنجاح');
}


    // عرض منتج معين
    public function show($id)
    {
        $item = Item::with('infos')->findOrFail($id);
        return view('items.show', compact('item'));
    }

    // نموذج تعديل منتج
public function edit($id)
{
    $item = Item::with('infos')->findOrFail($id);
    $info = $item->infos->first();
    $subCategories = SubProduct::all();
    return view('items.edit', compact('item', 'info', 'subCategories'));
}

    // حفظ التعديلات
   public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'sub_category_id' => 'required|exists:sub_products,id',
        'quantity' => 'required|integer|min:0',
        'expire_date' => 'nullable|date',
    ]);

    $item = Item::findOrFail($id);
    $item->update([
        'name' => $request->name,
        'description' => $request->description,
        'sub_category_id' => $request->sub_category_id,
    ]);

    // تحديث بيانات infos المرتبطة
    $info = $item->infos->first();
    if ($info) {
        $info->update([
            'quantity' => $request->quantity,
            'expire_date' => $request->expire_date,
        ]);
    } else {
        $item->infos()->create([
            'quantity' => $request->quantity,
            'expire_date' => $request->expire_date,
        ]);
    }

    return redirect()->route('items.index')->with('success', 'تم تحديث المنتج بنجاح');
}


    // حذف المنتج وكل معلوماته المرتبطة
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('items.index')->with('status', 'تم حذف المنتج بنجاح');
    }






}
