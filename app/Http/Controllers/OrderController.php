<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // قائمة الطلبيات الخاصة بالمستخدم الحالي
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['orderItems.item.subProduct.productCategory'])
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    // فورم إضافة طلبية جديدة
    public function create()
    {
        $products = \App\Models\Product::with('subProducts.items')->get();
        return view('orders.create', compact('products'));
    }

    // حفظ الطلبية الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'order_date' => 'required|date',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // إنشاء الطلبية وربطها بالمستخدم الحالي
        $order = Order::create([
            'user_id'    => auth()->id(),
            'order_date' => $request->order_date,
        ]);

        // إضافة المنتجات للطلبية
        foreach ($request->items as $orderItem) {
            $order->orderItems()->create([
                'item_id'  => $orderItem['item_id'],
                'quantity' => $orderItem['quantity'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'تم إضافة الطلبية بنجاح');
    }
    public function edit($id)
    {
        $order = Order::with('orderItems.item.subProduct.productCategory')->where('user_id', auth()->id())->findOrFail($id);
        $products = \App\Models\Product::with('subProducts.items')->get();
        return view('orders.edit', compact('order', 'products'));
    }
    public function update(Request $request, $id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'order_date' => 'required|date',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order->update([
            'order_date' => $request->order_date,
        ]);

        // حذف كل عناصر الطلبية القديمة ثم إضافة الجديدة
        $order->orderItems()->delete();
        foreach ($request->items as $orderItem) {
            $order->orderItems()->create([
                'item_id'  => $orderItem['item_id'],
                'quantity' => $orderItem['quantity'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'تم تعديل الطلبية بنجاح');
    }
    public function destroy($id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'تم حذف الطلبية بنجاح');
    }

    public function sendOrder($orderId)
{
    $order = \App\Models\Order::findOrFail($orderId);

    // تحقق إذا تم إرسالها سابقاً
    $alreadySent = \App\Models\HealthUnitOrder::where('order_id', $orderId)->exists();
    if ($alreadySent) {
        return back()->with('success', 'تم إرسال هذه الطلبية بالفعل.');
    }

    // احفظ الطلبية الجديدة في جدول health_unit_orders
    \App\Models\HealthUnitOrder::create([
        'order_id' => $orderId,
        'user_id' => auth()->id(),
        'status' => 'قيد التجهيز'
    ]);

    return back()->with('success', 'تم إرسال الطلبية بنجاح.');
}

}
