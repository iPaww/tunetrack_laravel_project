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
    <link rel="stylesheet" href="{{ asset('assets/css/admin/courses.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/topics.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <span class="hamburger-menu" id="toggle-sidebar">
            <i class="fas fa-bars"></i>
        </span>
        <div class="title">Tune Track</div>
        <div class="profile">
            <a href="/admin/profile">
                <img src="{{ !empty(session('admin_user.profile_picture')) &&
                file_exists(public_path(session('admin_user.profile_picture')))
                    ? asset(session('admin_user.profile_picture'))
                    : asset('assets/images/default/admindp.jpg') }}"
                    alt="Profile Picture">
            </a>
        </div>
    </div>


    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3>Menu</h3>

        
        <div class="menu-item">
            <a href="/admin" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </div>
   
        @if (session('admin_user.role')==2)
            <div class="menu-item">
                <a href="/admin/appointment"><i class="fas fa-calendar-check"></i> Appointment</a>
            </div>
        @endif

        <div class="menu-item">
            <a href="/admin/inventory"><i class="fas fa-warehouse"></i> Inventory</a>
        </div>
        <div class="menu-item">
            <a href="/admin/products"><i class="fas fa-cogs"></i> Products</a>
        </div>
        <div class="menu-item">
            <a href="/admin/topics"><i class="fas fa-book"></i> Topics </a>
        </div>
        <div class="menu-item">
            <a href="/admin/courses"><i class="fas fa-chalkboard-teacher"></i> Courses </a>
        </div>
        <div class="menu-item">
            <a href="/admin/quiz"><i class="fas fa-pencil-alt"></i> Quiz</a>
        </div>

        @if (session('admin_user.role') == 1)
            <!-- This should only be available to super admin role -->
            <h3> Admin Menu</h3>
            <div class="menu-item">
                <a href="/admin/main-category"><i class="fas fa-th-large"></i> Main Category</a>
            </div>
            <div class="menu-item">
                <a href="/admin/sub-category"><i class="fas fa-layer-group"></i> Sub Category</a>
            </div>
            <div class="menu-item">
                <a href="/admin/users"><i class="fas fa-users-cog"></i> User Management</a>
            </div>
        @endif

        <h3>Settings</h3>
        <div class="menu-item">
            <a href="/admin/item-track"><i class="fas fa-boxes"></i> Item Track</a>
        </div>
        <div class="menu-item">
            <a href="/admin/profile"><i class="fas fa-user-cog"></i> Account Settings</a>
        </div>
        <div class="menu-item">
            <a href="/admin/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>


    <div class="dashboard-content">
        <!-- Main Content -->
        <div class="content" id="content">
