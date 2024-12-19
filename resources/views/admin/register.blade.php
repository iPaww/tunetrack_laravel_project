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
    .form-select{
        width: 35%;
        height: 40px;
    }
    .alert-info {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
        padding: 10px;
        margin-top: 10px;
    }
    input.is-invalid {
        background-color: #ffb3ad;
        border: 1px solid red;
    }
</style>
<div class="container login-container d-flex flex-lg-row flex-column align-items-center py-5">
    <!-- Logo Section -->
    <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center p-4">
        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" class="img-fluid">
    </div>

    <!-- Register Form -->
    <div id="registerForm" class="form col-lg-6 col-12 p-4" style="background-color: #ffa07a;">
        <h2 class="text-center text-white mb-4">Register</h2>
        <form action="/register" method="post">
            @csrf <!-- {{ csrf_field() }} -->
            <input class="text-center fs-4 @error('fullname') is-invalid @enderror" type="text" name="fullname" placeholder="Fullname" value="{{ old('fullname') }}" required>
            <input class="text-center fs-4 @error('phone_number') is-invalid @enderror" type="text" name="phone_number" placeholder="PhoneNumber" value="{{ old('phone_number') }}" required>
            <input class="text-center fs-4 @error('address') is-invalid @enderror" type="text" name="address" placeholder="Address" value="{{ old('address') }}" required>
            <input class="text-center fs-4 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input class="text-center fs-4 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
            <input class="text-center fs-4 @error('confirm_password') is-invalid @enderror" type="password" name="confirm_password" placeholder="Confirm Password" required>
            

            <!-- Button trigger modal -->
            <div class="d-flex justify-content-center mt-3 mb-2">
            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Terms and Conditions
            </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Conditions:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    1. Consent: The users agree to partake in providing their feedback and insights regarding the functionality and effectiveness of the web-based e-learning platform for JCS Music Store by participating in this study.
                    <br><br>2. Confidentiality: Any personal information collected during the course of the study shall be kept confidential and used exclusively for research purposes. No participant shall be identified in the reports or publication that derive from the study.

                    <br><br>3. Data Use: All collected information for the study will be used for research purposes only and will not be transferred to any third party without permission from the respondents.

                    <br><br>4. System Feedback: The participants are asked to give honest and constructive feedback regarding the e-learning platform and ordering system. This will help in improving the platform further as well as the experience of the users.

                    <br><br>5. Compliance: Participants are expected to follow guidelines and instructions given by researchers for the study. Misuse of the platform and any term condition violation may lead to disqualification from the study.

                    <br><br>6. Ownership: The entire developed system comprising all its parts and functionalities is owned by JCS Music Store. The participants agree that they are only offering feedback and insights that would help develop the platform to become a better one.

                    <br><br>7. Liability: Neither the researchers nor the JCS Music Store will be held responsible or liable for any problem or damages caused due to participation in the study. Participants take their risk by participating voluntarily.

                    <br><br>8. Contact Information: Participants may contact the researchers in case any kind of query or issues emerge regarding this study. The researches would make best efforts to answer the queries as early as possible and further assistance shall be provided when needed.

                    <br><br>By accepting to participate in this study, participants affirm that they have read, understood, and agreed to the conditions listed above.
                    </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it!</button>
                    </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="button">Sign Up</button>
            </div>
            @if ($errors->any())
            <ul class="list-group my-2">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <div class="text-center mt-5">
                <a href="/login" class="text-decoration-none toggle-link">Already have an account?<br>Log in here</a>
            </div>
        </form>
    </div>
</div>