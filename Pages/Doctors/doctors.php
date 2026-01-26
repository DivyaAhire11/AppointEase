<?php
include "../../config/db.php";
$result = pg_query($conn, "SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Doctors</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="../../Style/base/navbar.css">
<link rel="stylesheet" href="../../Style/base/footer.css">
<link rel="stylesheet" href="../../Style/pages/doctors.css">
</head>

<body>
<?php include "../../Includes/navbar.php"; ?>

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

<?php include "../../Includes/footer.php"; ?>
</body>
</html>
