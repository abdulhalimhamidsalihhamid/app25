<?php

namespace App\Http\Controllers;

use App\Models\ItemInfo;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemInfoController extends Controller
{
    // عرض جميع معلومات المنتجات
    public function index()
    {
        // كل معلومات المنتجات مع المنتج المرتبط
        $iteminfos = ItemInfo::with('item')->get();
        return view('iteminfos.index', compact('iteminfos'));
    }

    // عرض نموذج إضافة معلومات منتج
    public function create()
    {
        // كل المنتجات للاختيار منها
        $items = Item::all();
        return view('iteminfos.create', compact('items'));
    }

    // تخزين معلومات منتج جديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:0',
            'expire_date' => 'required|date',
        ]);

        ItemInfo::create($validated);

        return redirect()->route('iteminfos.index')->with('status', 'تم إضافة معلومات المنتج بنجاح');
    }

    // عرض معلومات منتج معينة
    public function show($id)
    {
        $iteminfo = ItemInfo::with('item')->findOrFail($id);
        return view('iteminfos.show', compact('iteminfo'));
    }

    // نموذج تعديل معلومات منتج
    public function edit($id)
    {
        $iteminfo = ItemInfo::findOrFail($id);
        $items = Item::all();
        return view('iteminfos.edit', compact('iteminfo', 'items'));
    }

    // حفظ التعديلات
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:0',
            'expire_date' => 'required|date',
        ]);

        $iteminfo = ItemInfo::findOrFail($id);
        $iteminfo->update($validated);

        return redirect()->route('iteminfos.index')->with('status', 'تم تعديل معلومات المنتج بنجاح');
    }

    // حذف معلومات منتج
    public function destroy($id)
    {
        $iteminfo = ItemInfo::findOrFail($id);
        $iteminfo->delete();
        return redirect()->route('iteminfos.index')->with('status', 'تم حذف معلومات المنتج بنجاح');
    }
}
