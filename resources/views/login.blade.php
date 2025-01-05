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
        }

        .nav-bar {
            background-color: #000;
            padding: 5px 5px;
            color: white;
        }

        .title-banner {
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            transform: translateY(-3px);
        }

        .title-banner:hover {
            background-color: #333;
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

        .search-bar {
            width: 100%;
            max-width: 500px;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 16px;
        }

        /* Hover effect for .set-banner */
        .set-banner {
            font-size: 16px;
            cursor: pointer;
            position: relative;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .set-banner:hover {
            color: black;
            transform: translateY(-3px);
        }

        /* Optional underline animation */
        .set-banner::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: black;
            transition: width 0.3s ease;
        }

        .set-banner:hover::after {
            width: 100%;
        }


        .text-white {
            font-weight: bold;
        }

        @media (max-width: 768px) {

            .home-banner,
            .nav-bar {
                text-align: center;
            }

            .title-home {
                font-size: 2rem;
            }

            .title-home-2 {
                font-size: 1.2rem;
            }
        }

        .toggle-container {
            display: inline-flex;
            border: 2px solid black;
            border-radius: 30px;
            overflow: hidden;
            background-color: #555;
        }

        /* Profile Image inside header */
        .profile-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            margin-left: 15px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

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
                flex-direction: column;
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
</head>
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
            <input class="text-center fs-4 @error('email') is-invalid @enderror" type="email" name="email"
                placeholder="Email" value="{{ old('email') }}" required>
            <input class="text-center fs-4 @error('password') is-invalid @enderror" type="password" name="password"
                placeholder="Password" value="{{ old('password') }}" required>
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
                <a href="/register" class="text-decoration-none toggle-link">Don’t have an account?<br>Create account
                    here</a>
            </div>
        </form>
    </div>
</div>
@include('includes/footer')
