<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Medical Services</title>
<link rel="stylesheet" href="../../Style/pages/services.css">
</head>

<body>
<?php include "../../Includes/navbar.php"; ?>

<div class="header">
    <h1>Our Medical Services</h1>
    <p>Select a service to view available doctors</p>
</div>

<div class="services">

<a href="doctors_by_service.php?specialist=Cardiologist" class="card">
    <div class="icon">❤️</div>
    <h3>Cardiology</h3>
    <p>Heart care & cardiac specialists</p>
</a>

<a href="doctors_by_service.php?specialist=Dermatologist" class="card">
    <div class="icon">🩹</div>
    <h3>Dermatology</h3>
    <p>Skin, hair & cosmetic care</p>
</a>

<a href="doctors_by_service.php?specialist=Pediatrician" class="card">
    <div class="icon">👶</div>
    <h3>Pediatrics</h3>
    <p>Child healthcare specialists</p>
</a>

<a href="doctors_by_service.php?specialist=Orthopedic" class="card">
    <div class="icon">🦴</div>
    <h3>Orthopedics</h3>
    <p>Bone & joint specialists</p>
</a>

</div>

<?php include "../../Includes/footer.php"; ?>
</body>
</html>
