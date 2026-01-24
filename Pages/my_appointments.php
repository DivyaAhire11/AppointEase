<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit;
}

include "./config/db.php";

$patient_id = $_SESSION['user_id'];

$result = pg_query_params(
    $conn,
    "SELECT a.*, d.name AS doctor 
     FROM appointments a 
     JOIN doctors d ON a.doctor_id = d.id
     WHERE patient_id = $1
     ORDER BY appointment_date DESC",
    array($patient_id)
);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Appointments</title>
<link rel="stylesheet" href="../../Style/appointment.css">
</head>

<body>

<h2 style="text-align:center;">My Appointments</h2>

<table>
<tr>
    <th>Doctor</th>
    <th>Date</th>
    <th>Time</th>
    <th>Action</th>
</tr>

<?php while($row = pg_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo htmlspecialchars($row['doctor']); ?></td>
    <td><?php echo $row['appointment_date']; ?></td>
    <td><?php echo $row['appointment_time']; ?></td>
    <td>
        <a href="../../cancel.php?id=<?php echo $row['id']; ?>">Cancel</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
