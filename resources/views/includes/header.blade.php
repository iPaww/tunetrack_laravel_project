<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($page_title) ? $page_title : 'TuneTrack' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Background image */
        body {
            margin: 0;
            padding: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            overflow: auto;
        }

        /* Banner */
        .home-banner {
            background-color: #FC6A03;
            color: white;
            padding: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        .centered-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .title-home {
            font-size: 2.5rem;
            font-weight: bold;
            color: #FC6A03;
            margin-bottom: 0.5rem;
        }

        .title-home-2 {
            font-size: 1.5rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .navbar {
            background-color: #FC6A03;
        }

        .navbar .navbar-brand, .navbar .nav-link {
            color: white;
        }

        .navbar .nav-link:hover {
            color: black;
        }

        .navbar-toggler {
            border-color: white;
        }

        /* Custom styles for notifications */
        .dropdown-menu {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            max-height: 200px;
            overflow-y: auto;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #e9ecef;
        }

        .badge {
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }

        .dropdown-item span {
            font-weight: bold;
            color: #FC6A03;
        }

        /* Status background colors */
        .status-pending {
            background-color: #d3d3d3;
        }

        .status-processing {
            background-color: #ffeb3b;
        }

        .status-ready {
            background-color: #4caf50;
        }

        .status-decline {
            background-color: #f8d7da;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar .title-banner {
                display: none;
            }

            .navbar .nav-item {
                text-align: center;
            }

            .navbar .nav-link {
                font-size: 0.9rem;
            }

            .home-banner {
                flex-direction: column;
                text-align: center;
                padding: 12px;
            }

            .profile-image {
                width: 35px;
                height: 35px;
            }

            .navbar .navbar-brand {
                font-size: 0.9rem;
            }

            .dropdown-menu {
                width: 100%;
            }

            .dropdown-item {
                padding: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .title-home {
                font-size: 1.8rem;
            }

            .title-home-2 {
                font-size: 1.2rem;
            }

            .profile-image {
                width: 30px;
                height: 30px;
            }
            .title-banner{
                display: block;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3paNdF+Ap7r1L1N9j+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <!-- container-fluid -->
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="title-banner me-4"><a href="/" class="text-white text-decoration-none"><img
                            src="{{ asset('assets/images/logo/logo.png') }}" style="max-width: 80px;"
                            alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/elearning">E-Learning</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/shop">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/appointment">Book Tutorial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about-us">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/shop/cart">
                                <i class="fa-solid fa-cart-shopping"></i>
                                @if (isset($cart_count) && $cart_count > 0)
                                    <span class="badge bg-primary">{{ number_format($cart_count) }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bell"></i> Notifications
                             @if (isset($unreadCount) && $unreadCount > 0)
                                <span class="badge bg-warning text-dark">{{ $unreadCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                             @if (isset($notifications) || $notifications->count() > 0)
                                @php
                                    $statusMap = [
                                        1 => ['text' => 'Pending', 'icon' => 'fa-clock', 'class' => 'bg-secondary text-white'],
                                        2 => ['text' => 'Processing', 'icon' => 'fa-spinner', 'class' => 'bg-warning text-dark'],
                                        3 => ['text' => 'Ready to Pickup', 'icon' => 'fa-check-circle', 'class' => 'bg-success text-white'],
                                        4 => ['text' => 'Decline', 'icon' => 'fa-times-circle', 'class' => 'bg-danger text-white'],
                                    ];
                                @endphp
                                @foreach ($notifications as $notification)
                                    @php
                                        $status = $statusMap[$notification->status] ?? ['text' => 'Unknown', 'icon' => 'fa-question-circle', 'class' => 'bg-dark text-white'];
                                    @endphp
                                    <li @class([ 'dropdown-item d-flex align-items-center'=>true,'bg-dark-subtle ' => !$notification->is_read ])>
                                        <i class="fa {{ $status['icon'] }} me-2 {{ $status['class'] }}" style="padding: 5px; border-radius: 50%;"></i>
                                        <div>
                                            <a href="/shop/order/{{$notification->id}}/view" style="text-decoration: none;">
                                                <strong>Order #{{ $notification->id }}:</strong> {{ $notification->item_name ?? 'Item' }}
                                                <div class="text-muted small">{{ $status['text'] }}</div>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <span class="dropdown-item text-center text-muted">No new notifications</span>
                                </li>
                            @endif
                        </ul>
                        </li>
                    </ul>
                </div>

                <a class="navbar-brand" href="/{{ session('id') ? 'profile' : 'login' }}">
                    <img src="{{ !empty(session('profile_picture')) && file_exists(public_path(session('profile_picture')))
                        ? asset(session('profile_picture'))
                        : asset('assets/images/default/admindp.jpg') }}"
                        alt="Profile Image" class="profile-image" style="width: 40px; height: 40px; border-radius: 50%;">
                    <span class="ms-2 d-none d-lg-inline">{{ session('id') ? session('fullname') : 'Guest' }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </nav>
    </div>
</body>
</html>
