@include('includes/header')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<div style="min-height: 75vh">
    @include($page)
</div>
@include('includes/footer')