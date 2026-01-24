<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit;
}

include "../../config/db.php";

if (!isset($_GET['id'])) {
    header("Location: doctors.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM doctors WHERE id = $1";
$result = pg_query_params($conn, $query, array($id));
$doctor = pg_fetch_assoc($result);

if (!$doctor) {
    echo "Doctor not found";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link rel="stylesheet" href="../../Style/pages/doctor_details.css">
</head>

<body>
    <?php include "../../Includes/navbar.php"; ?>

<div class="profile">
    <img src="../../images/<?php echo htmlspecialchars($doctor['image']); ?>">
    <div class="info">
        <h1><?php echo htmlspecialchars($doctor['name']); ?></h1>
        <div class="badge"><?php echo htmlspecialchars($doctor['specialist']); ?></div>
        <p><strong>Experience:</strong> <?php echo htmlspecialchars($doctor['experience']); ?></p>
        <p><?php echo htmlspecialchars($doctor['description']); ?></p>

        <a class="btn" href="../book_appointment.php?doctor_id=<?php echo $doctor['id']; ?>">
            Book Appointment
        </a>

        <a class="btn" href="doctors.php">← Back to Doctors</a>
    </div>
</div>

<?php include "../../Includes/footer.php"; ?>
</body>
</html>
