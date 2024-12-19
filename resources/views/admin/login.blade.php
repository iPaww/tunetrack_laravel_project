<style>
input.is-invalid {
    background-color: #ffb3ad;
    border: 1px solid red;
}
</style>
<div class="container login-container d-flex flex-lg-row flex-column align-items-center">
    <!-- Logo Section -->
    <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center p-4">
        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" class="img-fluid">
    </div>

    <!-- Login Form -->
    <div id="loginForm" class="form col-lg-6 col-12 p-4" style="background-color: #ffa07a;">
        <h2 class="text-center mb-4 greeting" id="greeting"></h2>
        <h2 class="text-center text-white mb-4">Log In</h2>
        <form action="/admin/login" method="post">
            @csrf <!-- {{ csrf_field() }} -->
            <input class="text-center fs-4 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
            <input class="text-center fs-4 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required>
            <div class="d-flex justify-content-center">
                <button type="submit" class="button">Login</button>
            </div>
            @if ($errors->any())
            <ul class="list-group my-2">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <div class="text-center mt-5">
                <a href="registerLogin_form.php"  class="text-decoration-none toggle-link">Don’t have an account?<br>Create account here</a>
            </div>
        </form>
    </div>
</div>

<!-- Clock -->
<div class="clock" id="clock"></div>