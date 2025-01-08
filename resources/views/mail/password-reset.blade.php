<div style="min-height: 50vh; font-family: Arial, Helvetica, sans-serif;">
    <h1 style="font-size: calc(1.375rem + 1.5vw);">Hello {{ $user->fullname }},</h1>
    <h2 style="font-size: calc(1.325rem + .9vw); text-align: center;">You have requested for <b>password reset</b>!</h2>
    <p style="font-size: calc(1.275rem + .3vw); text-align: center;">
        If you requested for password reset kindly click the button below to redirect you into resetting your password
    </p>
    <div class="card text-bg-light border-0">
        <div class="card-body">
            <div style="
                font-size: 5em;
                font-weight: 500;
                text-align: center;
                text-transform: uppercase;
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
                "
            >
                <a 
                    style="color: white;
                    text-decoration: none;
                    background-color: #FC6A03;
                    text-align: center;
                    padding: 1.5rem;
                    border-radius: 5px;
                    "
                    href="{{ url("/password-reset?user=$user->id&authentication=$authentication_code") }}"
                    target="_blank">
                    Click here
                </a>
            </div>
        </div>
    </div>
    <p style="font-size: calc(1.275rem + .3vw); margin-bottom: 5rem;">
        If you did not do this password reset kindly ignore this email.
    </p>
    
    <div style="display: flex;
        justify-content: space-around;
        background-color: #212529;
        padding-top: 1.5rem;
        padding-bottom: 3rem;
        color: white;">
        <div>
            <div style="font-size: calc(1.275rem + .3vw)"><b>Follow Us On</b></div>
            <div>
                <a href="#" style="color: white; text-decoration: none;">Facebook</a>
                <a href="#" style="color: white; text-decoration: none;">Instagram</a>
            </div>
        </div>
        <div>
            @ Robinson, Gentri JCS Musical Instrument Shop 2nd floor near Watsons
        </div>
        <div>
            Since 2016
        </div>
    </div>
</div>