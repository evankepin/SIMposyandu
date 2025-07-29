<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel POSYANDU') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --success-color: #059669;
            --background-color: #f8fafc;
            --card-background: #ffffff;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--background-color);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, var(--card-background) 0%, #f1f5f9 100%);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--primary-color) !important;
            letter-spacing: -0.025em;
            transition: all 0.2s ease;
        }

        .navbar-brand:hover {
            color: var(--primary-hover) !important;
            transform: translateY(-1px);
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-secondary) !important;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background-color: rgba(37, 99, 235, 0.05);
            transform: translateY(-1px);
        }

        .nav-link:before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover:before {
            width: 80%;
        }

        /* Dropdown Styling */
        .dropdown-menu {
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-md);
            border-radius: 12px;
            padding: 0.5rem;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(37, 99, 235, 0.05);
            color: var(--primary-color);
            transform: translateX(4px);
        }

        /* Role Badge */
        .role-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            margin-left: 0.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s ease;
        }

        .role-badge:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-md);
        }

        /* Role-specific badge colors */
        .role-admin { background: linear-gradient(135deg, #dc2626, #b91c1c); }
        .role-kader { background: linear-gradient(135deg, var(--success-color), #047857); }
        .role-orangtua { background: linear-gradient(135deg, #7c3aed, #6d28d9); }

        /* Navbar toggler */
        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .navbar-toggler:hover {
            background-color: rgba(37, 99, 235, 0.05);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Main content area */
        main {
            min-height: calc(100vh - 80px);
            padding-top: 2rem;
        }

        /* Container improvements */
        .container {
            max-width: 1200px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .role-badge {
                font-size: 0.7rem;
                padding: 0.2rem 0.6rem;
                margin-left: 0.25rem;
            }
            
            .nav-link {
                padding: 0.75rem 1rem !important;
                margin: 0.125rem 0;
            }
        }

        /* Subtle animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        main {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Focus states for accessibility */
        .nav-link:focus,
        .dropdown-item:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'POSYANDU') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side -->
                    @auth
                        <ul class="navbar-nav me-auto">
                            @switch(Auth::user()->role)
                                @case('admin')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/dashboard') }}">Dashboard Admin</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('admin/kelola_user') }}">Kelola User</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('admin/posyandu') }}">Jadwal Posyandu</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('admin/balita') }}">Balita</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('admin/vendor') }}">Vendor</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('admin/vitamin') }}">Vitamin</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('admin/imunisasi') }}">Imunisasi</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('admin/kms') }}">KMS</a>
                                    </li>
                                    @break
                                @case('kader')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/kader/dashboard') }}">Dashboard Kader</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('admin/posyandu') }}">Jadwal Posyandu</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('kader/balitaa') }}">Balita</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{url('kader/kms') }}">KMS</a>
                                    </li>
                                    @break
                                @case('orangtua')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/orangtua/dashboard') }}">Dashboard Orang Tua</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/orangtua/jadwal') }}">Jadwal Posyandu</a>
                                    </li>
                                    <li><a class="nav-link" href="{{ route('orangtua.balita.index') }}">Data Balita Saya</a></li>
                                    @break
                            @endswitch
                        </ul>
                    @endauth

                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    <span class="role-badge text-uppercase role-{{ Auth::user()->role }}">
                                        {{ Auth::user()->role }}
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
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

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>
</body>
</html>