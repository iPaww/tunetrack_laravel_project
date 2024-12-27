<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($page_title) ? $page_title : 'TuneTrack' }}</title>
    <link rel="stylesheet" href="{{ asset("assets/css/home.css") }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Background image */
        body {
            margin: 0;
            padding: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;  /* Change from height to min-height */
            overflow: auto;  /* Allow content overflow if needed */
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
            color:black;
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
            .home-banner, .nav-bar {
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- container-fluid -->
    <div class="container-fluid p-0">
        <!-- Banner Section -->
        <div class="home-banner d-flex flex-column flex-md-row align-items-center justify-content-between p-3">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <div class="title-banner me-4"><a href="/" class="text-white text-decoration-none">TuneTrack</a></div>
                <div class="d-flex banner-items flex-wrap">
                    <a href="/elearnning" class="set-banner mx-2" style="text-decoration:none; color:white;">E-Learning</a>
                    <a href="/shop" class="set-banner mx-2" style="text-decoration:none; color:white;">Order</a>
                    <a href="/appointment" class="set-banner mx-2" style="text-decoration:none; color:white;">Appointment</a>
                    <a href="/contact" class="set-banner mx-2" style="text-decoration:none; color:white;">About Us</a>
                </div>
            </div>
             <!-- Profile Image & Name -->
             <div class="profile-container">
                <a href="/{{ session('id') ? 'profile' : 'login' }}" class="text-white text-decoration-none">
                    <img src="{{ !empty(session('profile_picture')) && file_exists(public_path('assets/images/users/'. session('id') .'/' . session('profile_picture'))) ? 
                        asset('assets/images/users/'. session('id') .'/' . session('profile_picture')): // TODO FIXME: This should use image of user
                        asset('assets/images/default/default_user.png')
                    }}" alt="Profile Image" class="profile-image">
                    <span class="text-white ms-2 fw-bold">{{ session('id') ? session('fullname') : 'Guest' }}</span>
                </a>
            </div>
        </div>