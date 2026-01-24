<?php
include "../../config/db.php";

$specialist = isset($_GET['specialist']) ? htmlspecialchars($_GET['specialist']) : 'Unknown';

$query = "SELECT * FROM doctors WHERE specialist = $1";
$result = pg_query_params($conn, $query, array($specialist));
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($specialist); ?> Doctors</title>
<link rel="stylesheet" href="../../Style/pages/doctors.css">
</head>

<body>
<?php include "../../Includes/navbar.php"; ?>

<div class="header">
    <h1><?php echo htmlspecialchars($specialist); ?> Doctors</h1>
</div>

<div class="container">

<?php while ($row = pg_fetch_assoc($result)) { ?>
    <div class="card">
        <img src="../../images/<?php echo htmlspecialchars($row['image']); ?>">
        <div class="card-content">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p>Experience: <?php echo htmlspecialchars($row['experience']); ?></p>
            <a class="btn" href="../Doctors/doctor_details.php?id=<?php echo $row['id']; ?>">
                View Profile
            </a>
        </div>
    </div>
<?php } ?>

</div>

<?php include "../../Includes/footer.php"; ?>
</body>
</html>
