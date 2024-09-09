<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/clash-display" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css">
    <style>
        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 350px;
            background: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            overflow-y: auto;
            transition: width 0.3s;
            z-index: 1000;
        }

        .sidebar a {
            display: block;
            color: #ecf0f1;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1abc9c;
            color: #fff;
        }

        /* Main content styles */
        .main-content {
            margin-left: 350px;
            width: calc(100% - 350px);
            padding: 20px;
            transition: margin-left 0.3s;
        }

        /* Top navbar styles */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 350px;
            width: calc(100% - 350px);
            background: #34495e;
            color: #ecf0f1;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            transition: width 0.3s, margin-left 0.3s;
        }

        .top-navbar .dropdown-menu {
            min-width: 200px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                display: none;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar.visible {
                display: block;
            }

            .top-navbar {
                left: 0;
                width: 100%;
            }

            .sidebar-toggle {
                display: block;
                background: #34495e;
                color: #ecf0f1;
                padding: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
        }

        /* Add Debtor Form styles */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .add-debtor-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-control {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Debtor Form styles */
        .debtor-form {
            display: none;
            background: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .debtor-form .form-label {
            color: #ecf0f1;
        }

        .debtor-form button[type="submit"] {
            background: #1abc9c;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .debtor-form button[type="submit"]:hover {
            background: #16a085;
        }

        /* Table Drag & Drop styles */
        .table-container {
            margin-top: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .table-container th {
            background-color: #f4f4f4;
        }

        .dragging {
            opacity: 0.5;
        }

        .btn-action {
            display: inline-block;
            margin: 0 5px;
        }

        .navbar-nav .dropdown-menu {
            min-width: 150px;
        }

        .navbar-nav .dropdown-item:hover {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <!-- <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button> -->
        <a href="{{ route('debtor.index') }}" id="debtors-btn"><i class="fas fa-list m-2"></i>{{ __('messages.debtors_show') }}</a>
        <a href="{{ route('debtor.create') }}" id="add-debtors-btn"><i class="fas fa-plus m-2"></i>{{ __('messages.add_debtors') }}</a>
    </div>

    <div class="top-navbar">
        <div class="top-navbar-left">
        </div>
        <div class="top-navbar-right">
            <ul class="navbar-nav d-flex flex-row">
                <!-- Language Dropdown -->
                <li class="nav-item dropdown mb-2" style="margin-right: 10px;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (app()->getLocale() == 'en')
                        <span class="fi fi-gb" style="font-size: 16px;"></span> English
                        @elseif(app()->getLocale() == 'ru')
                        <span class="fi fi-ru" style="font-size: 16px;"></span> Русский
                        @else
                        <span class="fi fi-uz" style="font-size: 16px;"></span> Uzbek
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <form method="POST" action="{{ route('change.language') }}">
                            @csrf
                            <button type="submit" name="lang" value="en" class="dropdown-item">
                                <span class="fi fi-gb" style="font-size: 16px;"></span> English
                            </button>
                            <button type="submit" name="lang" value="ru" class="dropdown-item">
                                <span class="fi fi-ru" style="font-size: 16px;"></span> Русский
                            </button>
                            <button type="submit" name="lang" value="uz" class="dropdown-item">
                                <span class="fi fi-uz" style="font-size: 16px;"></span> Uzbek
                            </button>
                        </form>
                    </ul>
                </li>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="/user/profile"><i class="fas fa-user"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>


                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <!-- Main Content Here -->
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            var sidebar = document.querySelector('.sidebar');
            var mainContent = document.querySelector('.main-content');
            if (sidebar.classList.contains('visible')) {
                sidebar.classList.remove('visible');
                mainContent.style.marginLeft = '0';
                mainContent.style.width = '100%';
            } else {
                sidebar.classList.add('visible');
                mainContent.style.marginLeft = '350px';
                mainContent.style.width = 'calc(100% - 350px)';
            }
        }
    </script>
</body>

</html>