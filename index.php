<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AppointEase - Book doctor appointments online easily and quickly. Find trusted healthcare professionals and schedule appointments in minutes.">
    <meta name="keywords" content="doctor appointment, healthcare booking, online consultation, medical appointment">
    <meta name="author" content="AppointEase">
    <title>AppointEase - Book Doctor Appointments Online</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <!-- Navigation -->
    <div class="page1">
        <?php include 'Includes/navbar.php'; ?>

        <!-- Hero Section -->
        <?php include 'Includes/homePage1.php'; ?>
    </div>

    <!-- Specialists Section -->
    <div class="homePage2">
        <?php include 'Includes/homePage2.php'; ?>
    </div>

    <!-- Features Section -->
    <section class="features-section">
        <div class="features-header">
            <h2>Why Choose AppointEase?</h2>
            <p>We make healthcare scheduling simple, secure, and accessible</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🏥</div>
                <h3>Trusted Doctors</h3>
                <p>All our doctors are verified professionals with years of experience in their specialties.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">⏰</div>
                <h3>Easy Scheduling</h3>
                <p>Book appointments in just a few clicks. Choose your preferred date and time with ease.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Secure & Private</h3>
                <p>Your health data is protected with industry-standard encryption and privacy measures.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Mobile Friendly</h3>
                <p>Access AppointEase from any device. Book appointments on the go, anytime, anywhere.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">💬</div>
                <h3>24/7 Support</h3>
                <p>Our customer support team is always ready to help you with any questions or concerns.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">✅</div>
                <h3>Instant Confirmation</h3>
                <p>Get instant confirmation of your appointment with reminders via SMS and email.</p>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Ready to Book Your Appointment?</h2>
            <p>Take the first step towards better healthcare. Schedule your consultation with a trusted doctor today.</p>
            <a href="Pages/bookAppoint.php" class="cta-btn">Book Now</a>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'Includes/footer.php'; ?>
    
    <script src="./JS/main.js"></script>
</body>

</html>