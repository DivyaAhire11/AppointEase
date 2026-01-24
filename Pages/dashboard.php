<?php
include "db.php";
$doctor_id = $_GET['doctor_id'];

$result = pg_query_params(
    $conn,
    "SELECT a.*, u.name AS patient
     FROM appointments a
     JOIN users u ON a.patient_id = u.id
     WHERE doctor_id = $1
     ORDER BY appointment_date, appointment_time",
    array($doctor_id)
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Doctor Dashboard</title>
<style>
body { font-family: Segoe UI; background:#e0f7fa; }
.card {
    width: 80%;
    margin: 50px auto;
    background: white;
    padding: 30px;
    border-radius: 15px;
}
</style>
</head>
<body>

<div class="card">
<h2>Doctor Appointments</h2>

<?php while($row = pg_fetch_assoc($result)) { ?>
<p>
👤 <?php echo $row['patient']; ?> |
📅 <?php echo $row['appointment_date']; ?> |
⏰ <?php echo $row['appointment_time']; ?>
</p>
<hr>
<?php } ?>

</div>
</body>
</html>
