<style>
    body {
        background-image:
        linear-gradient(rgba(0, 0, 0, 0.685), rgba(0, 0, 0, 0.11)),
        url('{{ asset('assets/images/landing/landing1.jpg') }}');
        background-size: cover;
    }

    .title-wrapper {
        display: inline-block;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
        text-align: center;
        animation: fadeIn 1s ease-in-out;
    }

    /* Title home styles */
    .title-home {
        font-size: 3rem;
        font-weight: bold;
        color: #FC6A03;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 10px;
        animation: slideInFromLeft 1s ease-out;
    }

    /* Second title styles */
    .title-home-2 {
        font-size: 2rem;
        font-weight: 600;
        color: #FC6A03;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
        animation: slideInFromRight 1s ease-out;
    }

    /* Keyframe animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideInFromLeft {
        from {
            transform: translateX(-50px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideInFromRight {
        from {
            transform: translateX(50px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>

<div class="centered-content" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="title-wrapper">
        <div class="title-home">Learn Instruments</div>
        <div class="title-home-2">With TuneTrack!</div>
    </div>
</div>
