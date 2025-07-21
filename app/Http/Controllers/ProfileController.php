<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // عرض نموذج تعديل الحساب الشخصي
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // حفظ التعديلات على الحساب الشخصي
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string|max:255',
            'health_unit' => 'nullable|string|max:255',
            'map_link'    => 'nullable|url|max:255',
            'password'    => 'nullable|string|min:8|confirmed',
        ]);

        $user->name        = $validated['name'];
        $user->phone       = $validated['phone'];
        $user->address     = $validated['address'];
        $user->health_unit = $validated['health_unit'];
        $user->map_link    = $validated['map_link'];

        // تغيير كلمة المرور فقط إذا تم إدخالها
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'تم تحديث بيانات الحساب بنجاح');
    }
}
