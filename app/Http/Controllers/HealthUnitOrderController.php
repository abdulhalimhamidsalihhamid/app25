<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthUnitOrder;

class HealthUnitOrderController extends Controller
{
       public function index()
    {
        // جلب جميع طلبيات الوحدات الصحية مع المستخدم والطلبية
        $healthUnitOrders = HealthUnitOrder::with(['user', 'order'])->latest()->get();
        return view('health_units.index', compact('healthUnitOrders'));
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:قيد التجهيز,قيد التوصيل,تم الاستلام,مرفوضة',
    ]);
    $huOrder = \App\Models\HealthUnitOrder::findOrFail($id);
    $huOrder->status = $request->status;
    $huOrder->save();
    return back()->with('success', 'تم تحديث حالة الطلبية بنجاح.');
}


public function warehouseStats()
{
    // إجمالي المنتجات
    $totalItems = \App\Models\Item::count();

    // إجمالي الكمية المخزنة
    $totalQuantity = \App\Models\ItemInfo::sum('quantity');

    // عدد الأصناف الرئيسية
    $totalCategories = \App\Models\Product::count();

    // عدد الأصناف الفرعية
    $totalSubCategories = \App\Models\SubProduct::count();

    // المنتجات منتهية الصلاحية
    $expiredItems = \App\Models\ItemInfo::where('expire_date', '<', now())->count();

    // المنتجات التي ستنتهي خلال 30 يوم
    $nearExpiredItems = \App\Models\ItemInfo::whereBetween('expire_date', [now(), now()->addDays(30)])->count();

    return view('health_units.stats', compact(
        'totalItems',
        'totalQuantity',
        'totalCategories',
        'totalSubCategories',
        'expiredItems',
        'nearExpiredItems'
    ));
}


}
