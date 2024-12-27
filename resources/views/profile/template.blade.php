@include('includes/header')
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
<!-- Sidebar and Main Content Layout -->
<div class="d-flex flex-column flex-md-row">
    <aside class="side-bar">
        <nav class="menu-ctgry">
            <a class="text-reset text-decoration-none" href="/profile"><div class="instruments-ctgry">Profile</div></a>
            <a class="text-reset text-decoration-none" href="/profile/learning"><div class="instruments-ctgry">My Learning</div></a>
            <a class="text-reset text-decoration-none" href="/profile/exam"><div class="instruments-ctgry">Exam</div></a>
            <a class="text-reset text-decoration-none" href="/profile/certificate"><div class="instruments-ctgry">Certificate</div></a>
            <a class="text-reset text-decoration-none" href="/shop/orders"><div class="instruments-ctgry">Track My Order</div></a>
            <a class="text-reset text-decoration-none" href="/logout"><div class="instruments-ctgry">Logout</div></a>
        </nav>
    </aside>
    <main class="main-content">
        @include($page)
    </main>
</div>
@include('includes/footer')