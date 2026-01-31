<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_id']);
?>

<nav class="navbar">
    <div class="logo">Appoint<span>Ease</span></div>
    <!-- Mobile toggle button -->
    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </button>

    <ul class="menu" id="menu">
        <li><a href="/AppointEase/index.php" class="nav-link">Home</a></li>
        <li><a href="/AppointEase/Pages/Services/services.php" class="nav-link">Services</a></li>
        <li><a href="/AppointEase/Pages/Doctors/doctors.php" class="nav-link">Doctors</a></li>
        
        <!-- <?php // if ($isLoggedIn): ?>
            <li><a href="/AppointEase/Pages/dashboard.php" class="nav-link">Dashboard</a></li>
            <li><a href="/AppointEase/Pages/my_appointments.php" class="nav-link">My Appointments</a></li>
            <li><span class="nav-link" style="color: #667eea; cursor: default;">👤 <?php // echo htmlspecialchars($_SESSION['user_name']); ?></span></li>
            <li><a href="/AppointEase/actions/logout.php" class="btn-primary nav-btn" style="background: #dc3545;">Logout</a></li>
        <?php //else: ?> -->

            <li><a href="/AppointEase/Pages/Login/login.php" class="nav-link">Login</a></li>
            <li><a href="/AppointEase/Pages/bookAppoint.php" class="btn-primary nav-btn">Book Appointment</a></li>
            
        <?php // endif; ?>
    </ul>
</nav>
<script>
    (function(){
        var toggle = document.getElementById('navToggle');
        var menu = document.getElementById('menu');
        if (!toggle || !menu) return;
        toggle.addEventListener('click', function(){
            var expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', String(!expanded));
            this.classList.toggle('active');
            menu.classList.toggle('active');
        });
    })();
</script>
