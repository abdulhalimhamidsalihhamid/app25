<!doctype html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Bootstrap Icons -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        body {
            background: #f6f8fa !important;
            min-height: 100vh;
            font-family: 'Nunito', sans-serif;
        }
        .navbar {
            background: linear-gradient(90deg, #04866a 0%, #02513e 100%);
            border-bottom: 2.5px solid #03543f25;
        }
        .navbar-brand, .navbar-nav .nav-link, .dropdown-menu .dropdown-item {
            color: #fff !important;
            font-weight: 700;
            letter-spacing: 1.2px;
        }
        .navbar-nav .nav-link i {
            margin-left: 4px;
            color: #d5ffea;
            font-size: 1.15em;
            vertical-align: middle;
            transition: color 0.2s;
        }
        .navbar-nav .nav-link.active, .navbar-nav .nav-link:focus, .navbar-nav .nav-link:hover {
            color: #f9e06e !important;
        }
        .navbar-nav .nav-link:hover i,
        .navbar-nav .nav-link.active i {
            color: #f9e06e;
        }
        .dropdown-menu {
            background: #04866a;
        }
        .dropdown-item:active, .dropdown-item:focus, .dropdown-item:hover {
            color: #fff !important;
            background: #02513e;
        }
        .dashboard-header {
            font-size: 2.1rem;
            font-weight: 900;
            color: #02513e;
            letter-spacing: 2px;
            text-align: center;
            background: #fff;
            border-radius: 2.3rem;
            box-shadow: 0 6px 22px 0 #02624713;
            border: 2px solid #02513e30;
            padding: .7rem 2rem;
            margin-bottom: 36px;
        }
        .dashboard-header i {
            color: #09996a;
            margin-left: 0.6rem;
            filter: drop-shadow(0 2px 6px #09996a26);
        }
        @media (max-width: 767px) {
            .dashboard-header { font-size: 1.15rem; padding: 0.5rem 0.8rem;}
        }

        .footer-main {
        background: linear-gradient(90deg, #04866a 0%, #02513e 100%);
        color: #fff;
        border-top: 2.5px solid #03543f25;
        box-shadow: 0 -2px 18px 0 #02856433;
        font-family: 'Nunito', sans-serif;
    }
    .footer-main a {
        color: #f9e06e !important;
        transition: color 0.2s;
    }
    .footer-main a:hover {
        color: #fff !important;
    }
    </style>
</head>
<body dir="rtl">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-hospital-fill"></i>
               مخزن وحدات الصحية
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="تبديل القائمة">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto align-items-center gap-1">

                    @auth
                        <li class="nav-item">
                            <a class="nav-link{{ request()->is('dashboard') ? ' active' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-shield-lock-fill"></i> لوحة التحكم
                            </a>
                        </li>

                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link{{ request()->routeIs('products.*') ? ' active' : '' }}" href="{{ route('products.index') }}">
                                    <i class="bi bi-folder-plus"></i> الأقسام الرئيسية
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ request()->routeIs('subproducts.*') ? ' active' : '' }}" href="{{ route('subproducts.create') }}">
                                    <i class="bi bi-folder-plus"></i> الأقسام الفرعية
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ request()->routeIs('items.*') ? ' active' : '' }}" href="{{ route('items.index') }}">
                                    <i class="bi bi-box2-heart"></i> الأصناف
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ request()->routeIs('users.*') ? ' active' : '' }}" href="{{ route('users.index') }}">
                                    <i class="bi bi-people-fill"></i> إدارة المستخدمين
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ request()->routeIs('healthUnitOrders.stats') ? ' active' : '' }}" href="{{ route('healthUnitOrders.stats') }}">
                                    <i class="bi bi-bar-chart-fill"></i> إحصائيات المخزن
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link{{ request()->routeIs('orders.*') ? ' active' : '' }}" href="{{ route('orders.index') }}">
                                    <i class="bi bi-cart-plus"></i> إدارة الطلبيات
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'delivery')
                            <li class="nav-item">
                                <a class="nav-link{{ request()->routeIs('healthUnitOrders.index') ? ' active' : '' }}" href="{{ route('healthUnitOrders.index') }}">
                                    <i class="bi bi-clipboard2-pulse"></i> طلبيات الوحدات الصحية
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link{{ request()->routeIs('profile.edit') ? ' active' : '' }}" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear-fill"></i> إعدادات الحساب
                            </a>
                        </li>
                    @endauth

                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right"></i> دخول
                                </a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus"></i> تسجيل
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end animate__animated animate__fadeInDown"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-gear"></i> تعديل حسابي
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> تسجيل الخروج
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
<footer class="footer-main py-3 mt-5">
    <div class="container text-center">
        <div class="mb-2">
            <a href="https://t.me/your_channel" class="mx-2 text-decoration-none text-success" target="_blank" title="Telegram">
                <i class="bi bi-telegram" style="font-size:1.4rem;"></i>
            </a>
            <a href="mailto:your@email.com" class="mx-2 text-decoration-none text-success" title="Email">
                <i class="bi bi-envelope" style="font-size:1.3rem;"></i>
            </a>
            <!-- أضف أي رابط تواصل آخر تريده -->
        </div>
        <small style="color:#04866a;font-weight:700">
            جميع الحقوق محفوظة &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}
            | تم التطوير بواسطة فريق النظام
        </small>
    </div>
</footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
