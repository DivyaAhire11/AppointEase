<?php
include "../../config/db.php";

// Get doctor ID from URL parameter
if (!isset($_GET['id'])) {
    header("Location: doctors.php");
    exit;
}

$id = (int)$_GET['id'];

// Fetch doctor details
$query = "SELECT * FROM doctors WHERE id = $1";
$result = pg_query_params($conn, $query, array($id));
$doctor = pg_fetch_assoc($result);

if (!$doctor) {
    header("Location: ../../Pages/error/404.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($doctor['name']); ?> - Doctor Profile | AppointEase</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../Style/base/navbar.css">
    <link rel="stylesheet" href="../../Style/base/footer.css">
    <link rel="stylesheet" href="../../Style/pages/doctor_details.css">
</head>

<body>
    <?php include "../../Includes/navbar.php"; ?>

    <div class="doctor-details-container">
        <!-- Back Button -->
        <div class="back-button">
            <a href="doctors.php"><i class="fas fa-arrow-left"></i> Back to Doctors</a>
        </div>

        <!-- Doctor Header Section -->
        <div class="doctor-profile">
            <div class="doctor-image">
                <img src="../../images/<?php echo htmlspecialchars($doctor['image'] ?? 'default-doctor.jpg'); ?>" 
                     alt="<?php echo htmlspecialchars($doctor['name']); ?>">
            </div>

            <div class="doctor-header">
                <h1><?php echo htmlspecialchars($doctor['name']); ?></h1>
                
                <div class="specialty-badge">
                    <i class="fas fa-stethoscope"></i>
                    <?php echo htmlspecialchars($doctor['specialist'] ?? $doctor['specialization'] ?? 'Medical Professional'); ?>
                </div>

                <div class="rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-text">4.5/5 (120 reviews)</span>
                </div>

                <div class="quick-info">
                    <div class="info-item">
                        <span class="label"><i class="fas fa-graduation-cap"></i> Experience</span>
                        <span class="value"><?php echo htmlspecialchars($doctor['experience'] ?? $doctor['experience_years'] ?? 'N/A'); ?> years</span>
                    </div>
                    <div class="info-item">
                        <span class="label"><i class="fas fa-hospital"></i> Status</span>
                        <span class="value status-active"><i class="fas fa-circle"></i> Available</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="content-grid">
            <!-- Left Column - About & Details -->
            <div class="left-column">
                <!-- About Section -->
                <section class="section">
                    <h2><i class="fas fa-user"></i> About</h2>
                    <p class="description">
                        <?php echo htmlspecialchars($doctor['bio'] ?? $doctor['description'] ?? 'Experienced medical professional dedicated to providing quality healthcare.'); ?>
                    </p>
                </section>

                <!-- Qualifications Section -->
                <section class="section">
                    <h2><i class="fas fa-certificate"></i> Qualifications</h2>
                    <div class="qualifications-list">
                        <div class="qualification-item">
                            <h4>MD - General Medicine</h4>
                            <p>Medical University of Excellence</p>
                        </div>
                        <div class="qualification-item">
                            <h4>Specialization</h4>
                            <p><?php echo htmlspecialchars($doctor['specialist'] ?? $doctor['specialization'] ?? 'Internal Medicine'); ?></p>
                        </div>
                        <div class="qualification-item">
                            <h4>Board Certification</h4>
                            <p>Board Certified Medical Professional</p>
                        </div>
                    </div>
                </section>

                <!-- Expertise Section -->
                <section class="section">
                    <h2><i class="fas fa-check-circle"></i> Expertise</h2>
                    <div class="expertise-tags">
                        <span class="tag">Patient Care</span>
                        <span class="tag">Diagnosis</span>
                        <span class="tag">Treatment Planning</span>
                        <span class="tag">Preventive Care</span>
                        <span class="tag">Clinical Skills</span>
                        <span class="tag">Medical Ethics</span>
                    </div>
                </section>
            </div>

            <!-- Right Column - Booking & Info -->
            <div class="right-column">
                <!-- Availability Section -->
                <section class="section availability-section">
                    <h2><i class="fas fa-calendar"></i> Availability</h2>
                    <div class="availability-grid">
                        <div class="day-availability">
                            <span class="day">Mon - Fri</span>
                            <span class="time">9:00 AM - 5:00 PM</span>
                        </div>
                        <div class="day-availability">
                            <span class="day">Saturday</span>
                            <span class="time">10:00 AM - 2:00 PM</span>
                        </div>
                        <div class="day-availability">
                            <span class="day">Sunday</span>
                            <span class="time">Closed</span>
                        </div>
                    </div>
                </section>

                <!-- Contact Info Section -->
                <section class="section contact-section">
                    <h2><i class="fas fa-info-circle"></i> Contact Information</h2>
                    <div class="contact-details">
                        <div class="contact-item">
                            <span class="icon"><i class="fas fa-phone"></i></span>
                            <span class="text">+1 (555) 123-4567</span>
                        </div>
                        <div class="contact-item">
                            <span class="icon"><i class="fas fa-envelope"></i></span>
                            <span class="text"><?php echo htmlspecialchars($doctor['email'] ?? 'contact@hospital.com'); ?></span>
                        </div>
                        <div class="contact-item">
                            <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                            <span class="text">Medical Center, Healthcare St, City</span>
                        </div>
                    </div>
                </section>

                <!-- Booking Section -->
                <section class="section booking-section">
                    <h2><i class="fas fa-calendar-check"></i> Book Appointment</h2>
                    <p class="booking-text">Ready to schedule your consultation?</p>
                    <a href="../bookAppoint.php?doctor_id=<?php echo $doctor['id']; ?>" class="btn-book">
                        <i class="fas fa-calendar-alt"></i> Book Now
                    </a>
                    <p class="booking-note">Appointments typically available within 2-3 days</p>
                </section>

                <!-- Reviews Section -->
                <section class="section reviews-section">
                    <h2><i class="fas fa-comments"></i> Patient Reviews</h2>
                    <div class="review">
                        <div class="reviewer-info">
                            <h4>John Doe</h4>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="review-text">"Excellent doctor! Very professional and caring. Highly recommended."</p>
                    </div>
                    <div class="review">
                        <div class="reviewer-info">
                            <h4>Sarah Smith</h4>
                            <div class="review-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="review-text">"Great experience! Dr. is very knowledgeable and patient."</p>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?php include "../../Includes/footer.php"; ?>
</body>

</html>
