<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Medical Services</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="../../Style/base/navbar.css">
<link rel="stylesheet" href="../../Style/base/footer.css">
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
    <div class="icon"><i class="fas fa-heart"></i></div>
    <h3>Cardiology</h3>
    <p>Heart care & cardiac specialists</p>
</a>

<a href="doctors_by_service.php?specialist=Dermatologist" class="card">
    <div class="icon"><i class="fas fa-spa"></i></div>
    <h3>Dermatology</h3>
    <p>Skin, hair & cosmetic care</p>
</a>

<a href="doctors_by_service.php?specialist=Pediatrician" class="card">
    <div class="icon"><i class="fas fa-baby"></i></div>
    <h3>Pediatrics</h3>
    <p>Child healthcare specialists</p>
</a>

<a href="doctors_by_service.php?specialist=Orthopedic" class="card">
    <div class="icon"><i class="fas fa-bone"></i></div>
    <h3>Orthopedics</h3>
    <p>Bone & joint specialists</p>
</a>

<a href="doctors_by_service.php?specialist=Neurologist" class="card">
    <div class="icon"><i class="fas fa-brain"></i></div>
    <h3>Neurology</h3>
    <p>Brain & nervous system care</p>
</a>

<a href="doctors_by_service.php?specialist=Ophthalmologist" class="card">
    <div class="icon"><i class="fas fa-eye"></i></div>
    <h3>Ophthalmology</h3>
    <p>Eye care & vision specialists</p>
</a>

<a href="doctors_by_service.php?specialist=ENT" class="card">
    <div class="icon"><i class="fas fa-ear"></i></div>
    <h3>ENT (Otolaryngology)</h3>
    <p>Ear, nose & throat specialists</p>
</a>

<a href="doctors_by_service.php?specialist=Psychiatrist" class="card">
    <div class="icon"><i class="fas fa-mind"></i></div>
    <h3>Psychiatry</h3>
    <p>Mental health & wellness care</p>
</a>

<a href="doctors_by_service.php?specialist=Gynecologist" class="card">
    <div class="icon"><i class="fas fa-venus"></i></div>
    <h3>Gynecology</h3>
    <p>Women's reproductive health</p>
</a>

<a href="doctors_by_service.php?specialist=Urologist" class="card">
    <div class="icon"><i class="fas fa-droplet"></i></div>
    <h3>Urology</h3>
    <p>Urinary & reproductive care</p>
</a>

</div>


 <?php include '../../Includes/footer.php'; ?>
</body>
</html>
