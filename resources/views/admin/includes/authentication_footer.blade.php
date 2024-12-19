<!-- Bootstrap JS and JavaScript Toggle Logic -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

    function getGreeting() {
        const hour = new Date().getHours();
        if (hour < 12) {
            return "Good Morning, Admin!";
        } else if (hour < 18) {
            return "Good Afternoon, Admin!";
        } else {
            return "Good Evening, Admin!";
        }
    }

    function updateGreeting(formId) {
        const greeting = getGreeting();
        document.getElementById('greeting').innerText = greeting;
        document.getElementById('greeting2').innerText = greeting;
        // Reset the animation by toggling classes
        document.getElementById('greeting').classList.remove('greeting'); // remove class to reset
        void document.getElementById('greeting').offsetWidth; // trigger reflow
        document.getElementById('greeting').classList.add('greeting'); // re-add class to restart animation
        // Reset for the register form
        document.getElementById('greeting2').classList.remove('greeting'); // remove class to reset
        void document.getElementById('greeting2').offsetWidth; // trigger reflow
        document.getElementById('greeting2').classList.add('greeting'); // re-add class to restart animation
    }

    // Function to update the clock
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').innerText = `${hours}:${minutes}:${seconds}`;
    }

    // Set initial greeting and start the clock when the page loads
    document.addEventListener("DOMContentLoaded", function() {
        updateGreeting("loginForm");
        updateClock();
        setInterval(updateClock, 1000); // Update clock every second
    });
</script>
</body>
</html>
