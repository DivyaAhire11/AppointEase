<?php
include "db.php";

$specialist = $_GET['specialist'];

$query = "SELECT * FROM doctors WHERE specialist = $1";
$result = pg_query_params($conn, $query, array($specialist));
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $specialist; ?> Doctors</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #e0f7fa;
    margin: 0;
}

.header {
    background: #006d6f;
    color: white;
    text-align: center;
    padding: 30px;
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
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
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
    color: #006d6f;
}

.btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    background: #009688;
    color: white;
    text-decoration: none;
    border-radius: 25px;
}
</style>
</head>

<body>

<div class="header">
    <h1><?php echo $specialist; ?> Doctors</h1>
</div>

<div class="container">

<?php while ($row = pg_fetch_assoc($result)) { ?>
    <div class="card">
        <img src="images/<?php echo $row['image']; ?>">
        <div class="card-content">
            <h3><?php echo $row['name']; ?></h3>
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
