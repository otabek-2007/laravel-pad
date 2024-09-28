<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debtors Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-mode {
            background-color: #1c1c1c;
            color: #c0c0c0;
        }

        .dark-mode .sidebar {
            background: #121212;
        }

        .dark-mode .top-navbar {
            background: #1c1c1c;
        }

        .dark-mode .modal-content {
            background: #2c3e50;
            color: #ecf0f1;
        }

        .dark-mode .modal-header,
        .dark-mode .modal-footer {
            border-color: #1abc9c;
        }

        .icon-sun,
        .icon-moon {
            font-size: 24px;
            cursor: pointer;
        }

        .icon-moon {
            display: none;
        }

        .dark-mode .icon-sun {
            display: none;
        }

        .dark-mode .icon-moon {
            display: inline;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background: #34495e;
            color: #ecf0f1;
            padding: 15px;
            overflow-y: auto;
            transition: width 0.3s;
            z-index: 1000;
        }

        .sidebar a {
            display: block;
            color: #ecf0f1;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: background 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1abc9c;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .top-navbar {
            position: fixed;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            background: #2c3e50;
            color: #ecf0f1;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 999;
            transition: margin-left 0.3s, width 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        #backButton {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #1abc9c;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #backButton:hover {
            background-color: #16a085;
        }

        #backButton i {
            margin-right: 5px;
        }

        .top-navbar .btn {
            margin-right: 10px;
        }

        .top-navbar-right {
            display: flex;
            gap: 10px;
            align-items: center;
        }



        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
                left: -220px;
            }

            .add-payment {
                position: fixed;
                left: 0px;
                top: 500px;
            }

            .sidebar.visible {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }



            .top-navbar {
                left: 0;
                width: 100%;
            }

            .sidebar-toggle {
                display: inline-block;
                background: #2c3e50;
                color: #ecf0f1;
                padding: 10px;
                border: none;
                cursor: pointer;
                border-radius: 5px;
                margin: 10px;
            }
        }


        @media (max-width: 270px) {
            .top-navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-navbar .top-navbar-right {
                margin-top: 10px;
                width: 100%;
                display: flex;
                justify-content: space-between;
            }

            .sidebar {
                width: 200px;
            }
        }
    </style>
</head>

<body>
    <button class="sidebar-toggle" onclick="toggleSidebar()">☰ Menu</button>

    <div class="sidebar">
        <a href="{{ route('debtor.index') }}" id="debtors-btn"><i class="fas fa-list m-2"></i> {{ __('messages.debtors_list') }}</a>
        @if(!empty($debtors))
        <a href="#" class="btn btn-primary add-payment" data-bs-toggle="modal" data-bs-target="#addPaymentModal">{{ __('messages.add_payments') }}</a>
        @endif
    </div>

    <div class="top-navbar">
        <button class="btn btn-secondary" id="darkModeToggle">
            <i class="fas fa-sun icon-sun"></i>
            <i class="fas fa-moon icon-moon"></i>
        </button>
        <div class="top-navbar-right">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDebtorModal">
                <i class="fas fa-plus"></i> {{ __('messages.add_debtor') }}
            </button>

            <ul class="navbar-nav d-flex flex-row">
                <!-- Language Dropdown -->
                <li class="nav-item dropdown">
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
                        <li><a class="dropdown-item" href="/user/profile"><i class="fas fa-user"></i> {{ __('messages.profile') }}</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                @method('POST')
                            </form>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('messages.logout') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content" style="margin-top: 100px;">
        <!-- Content will be dynamically included here -->
        @yield('content')
    </div>

    <!-- Add Debtor Modal -->
    <div class="modal fade" id="addDebtorModal" tabindex="-1" aria-labelledby="addDebtorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDebtorModalLabel">{{__('messages.add_debtors_form')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addDebtorForm" action="{{ route('debtor.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('messages.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter debtor's name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">{{__('messages.address')}}</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">{{__('messages.phone')}}</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Debtor</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Add Payment Modal -->
    @if(!empty($debtor))
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentModal">Add Payment</a>
    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentModalLabel">{{__('messages.add_payments_form')}} {{ $debtor->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('payment.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="debtor_id" class="form-label">{{__('messages.debdor')}}</label>
                            <select name="debtor_id" id="debtor_id" class="form-select">
                                @foreach($debtors as $debtorOption)
                                <option value="{{ $debtorOption->id }}" {{ $debtorOption->id == $debtor->id ? 'selected' : '' }}>
                                    {{ $debtorOption->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="currency_id" class="form-label">{{__('messages.currency')}}</label>
                            <select class="form-select" id="currency_id" name="currency_id" required>
                                @foreach($currency as $currencyOption)
                                <option value="{{ $currencyOption->id }}">{{ $currencyOption->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">{{ __("messages.amount")}}</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @php
    $currentUrl = Request::url();
    @endphp

    @if($currentUrl != url('/debtor/show'))
    <button id="backButton" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Back
    </button>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark mode toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
        });

        // Toggle sidebar visibility
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('visible');
        }
        document.getElementById('backButton').addEventListener('click', () => {
            window.location.href = '/debtor/show';
        });
    </script>
</body>

</html>