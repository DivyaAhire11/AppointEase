<?php
include "db.php";
$result = pg_query($conn, "SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html>
<head>
<title>Our Doctors</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #e0f7fa;
}

.header {
    background: linear-gradient(135deg, #006d6f, #009688);
    color: white;
    padding: 30px;
    text-align: center;
}

.container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 25px;
    padding: 40px;
}

.card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    overflow: hidden;
    transition: transform 0.3s;
}

.card:hover {
    transform: translateY(-10px);
}

.card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.card-content {
    padding: 20px;
}

.card-content h3 {
    margin: 0;
    color: #006d6f;
}

.card-content p {
    margin: 6px 0;
    color: #555;
}

.btn {
    display: inline-block;
    margin-top: 12px;
    padding: 10px 15px;
    background: #009688;
    color: white;
    text-decoration: none;
    border-radius: 25px;
}

.btn:hover {
    background: #006d6f;
}
</style>
</head>

<body>

<div class="header">
    <h1>Our Medical Specialists</h1>
    <p>Trusted doctors with years of experience</p>
</div>

<div class="container">
<?php while ($row = pg_fetch_assoc($result)) { ?>
    <div class="card">
        <img src="images/<?php echo $row['image']; ?>">
        <div class="card-content">
            <h3><?php echo $row['name']; ?></h3>
            <p><strong><?php echo $row['specialist']; ?></strong></p>
            <p>Experience: <?php echo $row['experience']; ?></p>
            <a class="btn" href="doctor_details.php?id=<?php echo $row['id']; ?>">
                View Profile
            </a>
        </div>
    </div>
<?php } ?>
</div>

</body>
</html>
