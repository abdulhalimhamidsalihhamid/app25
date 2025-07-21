<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * التحقق من صحة البيانات المدخلة
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'        => ['required', 'string', 'max:255'],
            'phone'       => ['required', 'string', 'max:30'],
            'address'     => ['required', 'string', 'max:255'],
            'map_link'    => ['nullable', 'url', 'max:255'],
            'health_unit' => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            // رسائل تحقق عربية مختصرة (اختياري)
            'name.required'        => 'يرجى إدخال الاسم الكامل.',
            'phone.required'       => 'يرجى إدخال رقم الهاتف.',
            'address.required'     => 'يرجى إدخال العنوان.',
            'health_unit.required' => 'يرجى إدخال اسم الوحدة الصحية.',
            'email.required'       => 'يرجى إدخال البريد الإلكتروني.',
            'password.required'    => 'يرجى إدخال كلمة المرور.',
        ]);
    }

    /**
     * إنشاء مستخدم جديد بعد تحقق التسجيل
     */
    protected function create(array $data)
    {
        return User::create([
            'name'        => $data['name'],
            'phone'       => $data['phone'],
            'address'     => $data['address'],
            'map_link'    => $data['map_link'] ?? null,
            'health_unit' => $data['health_unit'],
            'email'       => $data['email'],
            'role'        => 'user', // الصلاحية الافتراضية
            'password'    => Hash::make($data['password']),
        ]);
    }
}
