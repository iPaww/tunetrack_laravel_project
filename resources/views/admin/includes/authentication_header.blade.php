<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" referrerpolicy="no-referrer" />
    <style>
        body {
            position: relative; /* Allows positioning of clock */
        }
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
        .greeting {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 20px;
            background-color: rgba(255, 99, 71, 0.8); /* Light tomato color */
            padding: 10px;
            border-radius: 10px;
            white-space: nowrap;
            overflow: hidden;
            width: 0; /* Start with width 0 */
            animation: typing 3s steps(30, end) forwards, blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; } /* Adjust this according to the expected length of your greeting */
        }

        @keyframes blink-caret {
            from, to { border-right: 2px solid transparent; }
            50% { border-right: 2px solid rgba(255, 255, 255, 0); }
        }

        .clock {
            position: absolute;
            top: 20px; /* Distance from the top */
            right: 20px; /* Distance from the right */
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
            border-radius: 10px;
            text-align: center;
            border: 4px solid transparent;
            background-clip: padding-box;
            background-image: linear-gradient(white, white), radial-gradient(circle at 100% 100%, rgba(255, 0, 0, 1), rgba(0, 255, 0, 1), rgba(0, 0, 255, 1));
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            color: rgb(0, 0, 0);
            font-size: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
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
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 " style="background-color: rgb(250, 131, 110);">
