<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // عرض كل المستخدمين
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // تغيير الصلاحية
    public function changeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user,delivery,suspended'
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('status', 'تم تغيير الصلاحية بنجاح');
    }

    // حذف مستخدم
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('status', 'تم حذف المستخدم');
    }
}
