@include('includes/header')
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
<!-- Sidebar and Main Content Layout -->
<div class="d-flex flex-column flex-md-row">
    <aside class="side-bar">
        <nav class="menu-ctgry">
            <a class="text-reset text-decoration-none" href="/profile/learning">
                <div class="instruments-ctgry"><i class="fas fa-book"></i><span> My Courses </span></div>
            </a>
            <a class="text-reset text-decoration-none" href="/profile/exam">
                <div class="instruments-ctgry"><i class="fas fa-pen-alt"></i><span> Assesments </span></div>
            </a>
            <a class="text-reset text-decoration-none" href= "/profile/appointment">
                <div class="instruments-ctgry"><i class="fas fa-calendar"></i><span> My Booking </span></div>
            </a>
            <a class="text-reset text-decoration-none" href="/shop/orders">
                <div class="instruments-ctgry"><i class="fas fa-truck"></i><span> Track My Order </span></div>
            </a>
            <a class="text-reset text-decoration-none" href="/profile">
                <div class="instruments-ctgry"><i class="fas fa-user"></i><span> Profile </span></div>
            </a>
            <a class="text-reset text-decoration-none" href="/logout">
                <div class="instruments-ctgry"><i class="fas fa-sign-out-alt"></i><span> Logout </span></div>
            </a>
        </nav>
    </aside>
    <main class="main-content">
        @include($page)
    </main>
</div>
@include('includes/footer')
