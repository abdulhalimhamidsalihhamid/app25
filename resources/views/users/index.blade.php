@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center fw-bold text-primary">إدارة المستخدمين</h2>
    @if(session('status'))
        <div class="alert alert-success text-center mb-3">
            {{ session('status') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle" style="background: #fff;">
            <thead class="table-info">
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الإيميل</th>
                    <th>رقم الجوال</th>
                    <th>العنوان</th>
                    <th>الوحدة الصحية</th>
                    <th>رابط الخريطة</th>
                    <th>الصلاحية</th>
                    <th>التحكم</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->health_unit }}</td>
                        <td>
                            @if($user->map_link)
                                <a href="{{ $user->map_link }}" target="_blank" style="color:#04866a;">
                                    عرض على الخريطة
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('users.changeRole', $user->id) }}" style="display:inline-flex;">
                                @csrf
                                @method('PUT')
                                <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>مدير نظام</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>مستخدم</option>
                                    <option value="delivery" {{ $user->role == 'delivery' ? 'selected' : '' }}>موصل طلبات</option>
                                    <option value="suspended" {{ $user->role == 'suspended' ? 'selected' : '' }}>حساب موقوف</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المستخدم؟');" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-muted">لا يوجد مستخدمين حتى الآن.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
