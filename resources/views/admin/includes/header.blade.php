<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($page_title) ? $page_title : 'TuneTrack | Admin' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/item_track.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/profile.css') }}">

</head>
<body>
    <!-- Header -->
    <div class="header">
        <span class="hamburger-menu" id="toggle-sidebar">
            <i class="fas fa-bars"></i>
        </span>
        <div class="title">ADMIN DASHBOARD</div>
        <div class="profile">
            <a href="/admin/profile">
            <img src="{{ !empty(session('profile_picture')) && file_exists(public_path('assets/images/users/'. session('id') .'/' . session('profile_picture'))) ? 
                    asset('assets/images/users/'. session('id') .'/' . session('profile_picture')):
                    asset('assets/images/default/admindp.jpg')
            }}" alt="Profile Picture">
            </a>
        </div>
    </div>

    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3>Menu</h3>
        <div class="menu-item">
            <a href="/admin" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </div>
        <div class="menu-item">
            <a href="/admin/appointment"><i class="fas fa-chart-line"></i> Appointment</a>
        </div>
        <div class="menu-item">
            <a href="/admin/inventory"><i class="fas fa-warehouse"></i> Inventory</a>
        </div>
        <div class="menu-item">
            <a href="/admin/instruments">Instruments</a>
        </div>
        <div class="menu-item">
            <a href="/admin/quiz">Quiz</a>
        </div>
        <div class="menu-item">
            <a href="/admin/main-category">Main Category</a>
        </div>
        <div class="menu-item">
            <a href="/admin/sub-category">Sub Category</a>
        </div>
        
        @if ( session('role') == 1 )
        <!-- This should only be available to admin user role -->
        <h3>Super Admin Menu</h3>
        <div class="menu-item">
            <a href="/admin/sales">Reports</a>
        </div>
        <div class="menu-item">
            <a href="/admin/users">User Management</a>
        </div>
        @endif

        <h3>Settings</h3>
        <div class="menu-item">
            <a href="/admin/item-track">Item Track</a>
        </div>
        <div class="menu-item">
            <a href="/admin/profile">Account Settings</a>
        </div>
        <div class="menu-item">
            <a href="/admin/logout">Logout</a>
        </div>
    </div>

    <div class="dashboard-content">
        <!-- Main Content -->
        <div class="content" id="content">