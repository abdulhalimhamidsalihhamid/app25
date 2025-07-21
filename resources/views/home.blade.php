@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f6f8fa !important;
        min-height: 100vh;
    }
    .dashboard-header-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 36px;
        margin-bottom: 34px;
    }
    .dashboard-header {
        display: inline-block;
        font-size: 2.25rem;
        font-weight: 900;
        color: #02513e;
        letter-spacing: 2px;
        text-align: center;
        position: relative;
        padding: 0.6rem 2.2rem 0.6rem 2.2rem;
        background: #fff;
        border-radius: 2.3rem;
        box-shadow: 0 6px 22px 0 #02624713;
        border: 2px solid #02513e30;
    }
    .dashboard-header:before {
        content: '';
        position: absolute;
        bottom: -8px; left: 20%; right: 20%;
        height: 5px;
        border-radius: 5px;
        background: linear-gradient(90deg, #02513e 40%, #04c687 100%);
        opacity: 0.7;
    }
    .dashboard-icon {
        font-size: 2.2rem;
        color: #09996a;
        margin-bottom: 0.18rem;
        margin-right: 0.7rem;
        vertical-align: middle;
        filter: drop-shadow(0 2px 6px #09996a26);
    }
    .admin-action-card {
        background: linear-gradient(135deg, #04866a 0%, #02513e 100%);
        border-radius: 1.3rem;
        border: 2.7px solid #181818;
        box-shadow: 0 2px 18px 0 #02856433;
        padding: 2rem 1.5rem 1.2rem 1.5rem;
        text-align: center;
        transition: box-shadow 0.19s, transform 0.17s, border-color .22s;
        cursor: pointer;
        min-height: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
        position: relative;
        z-index: 1;
    }
    .admin-action-card:hover {
        box-shadow: 0 8px 32px 0 #18181822;
        transform: translateY(-5px) scale(1.035);
        border-color: #000;
        background: linear-gradient(135deg, #02513e 0%, #04866a 100%);
    }
    .admin-action-icon {
        font-size: 2.3rem;
        color: #d5ffea;
        margin-bottom: 1rem;
        transition: color 0.2s;
    }
    .admin-action-card:hover .admin-action-icon {
        color: #fff;
    }
    .admin-action-label {
        font-size: 1.14rem;
        font-weight: 600;
        color: #fff;
        margin-top: .5rem;
        letter-spacing: 1px;
        text-shadow: 0 1px 5px #00392533;
    }
    .admin-action-card:after {
        content: '';
        display: block;
        border-radius: inherit;
        border: 2.5px solid #111;
        position: absolute;
        top: 8px; left: 8px; right: 8px; bottom: 8px;
        z-index: -1;
        pointer-events: none;
        opacity: 0.13;
    }
    @media (max-width: 767px) {
        .dashboard-header { font-size: 1.15rem; padding: 0.5rem 0.8rem;}
        .dashboard-header:before { height: 3px; }
        .dashboard-header-container { margin-top: 16px; margin-bottom: 18px;}
        .admin-action-label { font-size: .98rem;}
        .admin-action-icon { font-size: 1.6rem;}
        .admin-action-card { padding: 1.1rem 0.5rem;}
    }
</style>
<div class="container py-3">
    <div class="dashboard-header-container">
        <span class="dashboard-header">
            <i class="bi bi-shield-lock-fill dashboard-icon"></i>
            لوحة تحكم النظام
        </span>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
 @if(Auth::user() && Auth::user()->role == 'admin')
    <!-- إضافة الأقسام -->
    <div class="col">
        <a href="{{ route('products.index') }}" class="text-decoration-none">
            <div class="admin-action-card">
                <i class="bi bi-folder-plus admin-action-icon"></i>
                <div class="admin-action-label">إضافة الأقسام</div>
            </div>
        </a>
    </div>

     <!-- إضافة الاقسام الفرعية -->
        <div class="col">
            <a href="{{ route('subproducts.create') }}" class="text-decoration-none">
                <div class="admin-action-card">
                    <i class="bi bi-folder-plus admin-action-icon"></i>
                    <div class="admin-action-label">إضافة الأقسام الفرعية</div>
                </div>
            </a>
        </div>
        <!-- إضافة الأصناف -->
        <div class="col">
            <a href="{{ route('items.index') }}" class="text-decoration-none">
                <div class="admin-action-card">
                    <i class="bi bi-box2-heart admin-action-icon"></i>
                    <div class="admin-action-label">إضافة الأصناف</div>
                </div>
            </a>
        </div>

@endif

 @if(Auth::user() && Auth::user()->role == 'user' || Auth::user() && Auth::user()->role == 'admin')
        <!-- إضافة طلبيات -->
        <div class="col">
            <a href="{{ route('orders.index') }}" class="text-decoration-none">
                <div class="admin-action-card">
                    <i class="bi bi-cart-plus admin-action-icon"></i>
                    <div class="admin-action-label">إضافة طلبيات</div>
                </div>
            </a>
        </div>
    @endif

     @if(Auth::user() && Auth::user()->role == 'admin' || Auth::user() && Auth::user()->role == 'delivery')
        <!-- عرض طلبيات الوحدات الصحية -->
        <div class="col">
            <a href="{{ route('healthUnitOrders.index')  }}" class="text-decoration-none">
                <div class="admin-action-card">
                    <i class="bi bi-clipboard2-pulse admin-action-icon"></i>
                    <div class="admin-action-label">عرض طلبيات الوحدات الصحية</div>
                </div>
            </a>
        </div>
        @endif

    @if(Auth::user() && Auth::user()->role == 'admin')
        <!-- إحصائية المخزن -->
        <div class="col">
            <a href="{{ route('healthUnitOrders.stats') }}" class="text-decoration-none">
                <div class="admin-action-card">
                    <i class="bi bi-bar-chart-fill admin-action-icon"></i>
                    <div class="admin-action-label">إحصائية المخزن</div>
                </div>
            </a>
        </div>
        <!-- التحكم في حساب المستخدمين -->
        <div class="col">
            <a href="{{ route('users.index') }}" class="text-decoration-none">
                <div class="admin-action-card">
                    <i class="bi bi-people-fill admin-action-icon"></i>
                    <div class="admin-action-label">التحكم في حساب المستخدمين</div>
                </div>
            </a>
        </div>
        @endif
        
        <!-- إعدادات الحسابات -->
        <div class="col">
            <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                <div class="admin-action-card">
                    <i class="bi bi-gear-fill admin-action-icon"></i>
                    <div class="admin-action-label">إعدادات الحسابات</div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
