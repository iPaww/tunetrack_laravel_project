<style>
    .login-container {
        max-width: 800px;
        border-radius: 12px;
        
    }
    .form {
        border-radius: 25px;
    }
    .form input {
        width: 100%;
        height: 40px;
        margin: 10px 5px;
        border-radius: 25px;
        border: none;
        padding: 0 15px;
    }
    .button {
        height: 40px;
        width: 100px;
        border-radius: 25px;
        border: none;
        color: white;
        background-color: tomato;
    }
    .button:hover {
        background-color: white;
        color: black;
    }
    .toggle-link {
        color: rgb(49, 32, 209);
        font-size: 14px;
    }
    /* Responsive adjustments */
    @media (max-width: 576px) {
        .login-container {
            flex-direction: column; /* Stack logo and form */
            padding: 20px;
        }
        .col-6 {
            max-width: 100%;
        }
    }
    input.is-invalid {
        background-color: #ffb3ad;
        border: 1px solid red;
    }
</style>
<div class="container login-container d-flex flex-lg-row flex-column align-items-center" style="min-height: 75vh;">
    <!-- Logo Section -->
    <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center p-4">
        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" class="img-fluid">
    </div>

    <!-- Login Form -->
    <div id="loginForm" class="form col-lg-6 col-12 p-4" style="background-color: #ffa07a;">
        <h2 class="text-center text-white mb-4">Log In</h2>
        <form action="/login" method="post">
            @csrf <!-- {{ csrf_field() }} -->
            <input class="text-center fs-4 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input class="text-center fs-4 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
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
                <a href="/register" class="text-decoration-none toggle-link">Don’t have an account?<br>Create account here</a>
            </div>
        </form>
    </div>
</div>

<script>
    
</script>