<?php
include "db.php";
$id = $_GET['id'];

$query = "SELECT * FROM doctors WHERE id = $1";
$result = pg_query_params($conn, $query, array($id));
$doctor = pg_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Doctor Profile</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right, #e0f7fa, #b2ebf2);
    margin: 0;
}

.profile {
    max-width: 900px;
    background: white;
    margin: 50px auto;
    border-radius: 20px;
    display: flex;
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    overflow: hidden;
}

.profile img {
    width: 40%;
    object-fit: cover;
}

.info {
    padding: 40px;
}

.info h1 {
    color: #006d6f;
}

.badge {
    display: inline-block;
    padding: 8px 15px;
    background: #00bcd4;
    color: white;
    border-radius: 20px;
    margin: 10px 0;
}

.info p {
    color: #555;
    line-height: 1.7;
}

.btn {
    margin-top: 20px;
    display: inline-block;
    padding: 12px 20px;
    background: #009688;
    color: white;
    text-decoration: none;
    border-radius: 30px;
}
</style>

</head>
<body>

<div class="profile">
    <img src="images/<?php echo $doctor['image']; ?>">
    <div class="info">
        <h1><?php echo $doctor['name']; ?></h1>
        <div class="badge"><?php echo $doctor['specialist']; ?></div>
        <p><strong>Experience:</strong> <?php echo $doctor['experience']; ?></p>
        <p><?php echo $doctor['description']; ?></p>

        <a class="btn" href="doctors.php">← Back to Doctors</a>
    </div>
</div>

</body>
</html>
