<?php
include "../../db.php";
$result = pg_query($conn, "SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html>
<head>
<title>Our Doctors</title>
<link rel="stylesheet" href="../../Style/doctors.css">
</head>

<body>

<div class="header">
    <h1>Our Medical Specialists</h1>
    <p>Trusted doctors with years of experience</p>
</div>

<div class="container">
<?php while ($row = pg_fetch_assoc($result)) { ?>
    <div class="card">
        <img src="../../images/<?php echo htmlspecialchars($row['image']); ?>">
        <div class="card-content">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p><strong><?php echo htmlspecialchars($row['specialist']); ?></strong></p>
            <p>Experience: <?php echo htmlspecialchars($row['experience']); ?></p>
            <a class="btn" href="doctor_details.php?id=<?php echo $row['id']; ?>">
                View Profile
            </a>
        </div>
    </div>
<?php } ?>
</div>

</body>
</html>
