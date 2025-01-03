<div style="min-height: 50vh; font-family: Arial, Helvetica, sans-serif;">
    <h1 style="font-size: calc(1.375rem + 1.5vw);">Hello {{ $user->fullname }},</h1>
    <h2 style="font-size: calc(1.325rem + .9vw); text-align: center;">You Are almost There!</h2>
    <p style="font-size: calc(1.275rem + .3vw); text-align: center;">
        Only one step left to become a part of Tunetrack member. Please enter
        this verification code in the window where you started creating your account
    </p>
    <div class="card text-bg-light border-0">
        <div class="card-body">
            <div style="color: white;
                font-size: 5em;
                font-weight: 500;
                background-color: #FC6A03;
                text-align: center;
                text-transform: uppercase;
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
                "
            >
                {{ $user->verification }}
            </div>
        </div>
    </div>
    <p style="font-size: calc(1.275rem + .3vw); margin-bottom: 5rem;">
        If you can't find the verification link please <a href="{{ url('/verification') }}" target="_blank">click here</a>.
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