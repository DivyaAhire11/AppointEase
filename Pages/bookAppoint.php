<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - AppointEase</title>
    <link rel="stylesheet" href="../Style/base/navbar.css">
    <link rel="stylesheet" href="../Style/base/footer.css">
    <link rel="stylesheet" href="../Style/pages/bookAppoint.css">
</head>

<body>
    <?php 
    include "../config/db.php";
    include "../config/auth_check.php";
    
    $user_id = $_SESSION['user_id'];
    $doctor_id = isset($_GET['doctor_id']) ? (int)$_GET['doctor_id'] : 0;
    $message = "";
    $message_type = "";
    
    // Fetch doctor details if provided
    $doctor = null;
    if ($doctor_id > 0) {
        $doc_result = pg_query_params($conn, "SELECT * FROM doctors WHERE id = $1", [$doctor_id]);
        $doctor = pg_fetch_assoc($doc_result);
    }
    
    // Handle appointment booking
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $doctor_id_post = (int)($_POST['doctor_id'] ?? 0);
        $date = $_POST['appointment_date'] ?? '';
        $time = $_POST['appointment_time'] ?? '';
        $reason = htmlspecialchars($_POST['reason'] ?? '');
        
        // Validation
        if (empty($doctor_id_post) || empty($date) || empty($time)) {
            $message = "Please fill in all required fields!";
            $message_type = "error";
        } else {
            // Check if doctor exists
            $doc_check = pg_query_params($conn, "SELECT id FROM doctors WHERE id = $1", [$doctor_id_post]);
            
            if (pg_num_rows($doc_check) == 0) {
                $message = "Invalid doctor selected!";
                $message_type = "error";
            } else {
                // Check for duplicate appointment
                $duplicate_check = pg_query_params(
                    $conn,
                    "SELECT id FROM appointments WHERE doctor_id = $1 AND appointment_date = $2 AND appointment_time = $3 AND status != 'cancelled'",
                    [$doctor_id_post, $date, $time]
                );
                
                if (pg_num_rows($duplicate_check) > 0) {
                    $message = "❌ This time slot is already booked. Please choose another time.";
                    $message_type = "error";
                } else {
                    // Book the appointment
                    $insert = pg_query_params(
                        $conn,
                        "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, reason, status) VALUES ($1, $2, $3, $4, $5, 'pending') RETURNING id",
                        [$user_id, $doctor_id_post, $date, $time, $reason]
                    );
                    
                    if ($insert) {
                        $message = "✅ Appointment booked successfully! You will receive a confirmation email shortly.";
                        $message_type = "success";
                        // Reset form
                        $doctor_id = 0;
                        $doctor = null;
                    } else {
                        $message = "Booking failed. Please try again.";
                        $message_type = "error";
                    }
                }
            }
        }
    }
    
    // Fetch all doctors for dropdown
    $doctors_result = pg_query($conn, "SELECT id, name, specialist FROM doctors ORDER BY name");
    ?>
    
    <?php include "../Includes/navbar.php"; ?>

    <div class="book-appointment">
        <h2>Book Your Appointment</h2>

        <div class="book-content">
            <div class="book-img">
                <img src="../images/two-female-doctors.avif" alt="Medical Professionals">
            </div>

            <form action="bookAppoint.php" method="POST" class="booking-form">
                <?php if (!empty($message)): ?>
                    <div class="message message-<?php echo $message_type; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="doctor_id">Select Doctor <span class="required">*</span></label>
                    <select name="doctor_id" id="doctor_id" required>
                        <option value="">Choose a Doctor</option>
                        <?php while ($doc = pg_fetch_assoc($doctors_result)): ?>
                            <option value="<?php echo $doc['id']; ?>" <?php echo ($doctor && $doctor['id'] == $doc['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($doc['name']); ?> - <?php echo htmlspecialchars($doc['specialist']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="appointment_date">Appointment Date <span class="required">*</span></label>
                    <input type="date" name="appointment_date" id="appointment_date" required min="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="form-group">
                    <label for="appointment_time">Appointment Time <span class="required">*</span></label>
                    <input type="time" name="appointment_time" id="appointment_time" required>
                </div>

                <div class="form-group">
                    <label for="reason">Reason for Visit</label>
                    <textarea name="reason" id="reason" rows="4" placeholder="Brief description of your symptoms or concern..."></textarea>
                </div>

                <button type="submit" class="btn-submit">Confirm Booking</button>
                <a href="../index.php" class="btn-cancel">Cancel</a>
            </form>
        </div>
    </div>

    <?php include "../Includes/footer.php"; ?>
</body>

</html>