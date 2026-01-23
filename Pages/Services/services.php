<!DOCTYPE html>
<html>
<head>
<title>Our Medical Services</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #e0f7fa;
}

.header {
    background: linear-gradient(135deg, #006d6f, #009688);
    color: white;
    text-align: center;
    padding: 40px;
}

.services {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 30px;
    padding: 50px;
}

.card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    transition: 0.3s;
    text-decoration: none;
    color: black;
}

.card:hover {
    transform: translateY(-10px);
}

.icon {
    width: 80px;
    height: 80px;
    background: #00bcd4;
    color: white;
    border-radius: 50%;
    font-size: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
}

h3 {
    color: #006d6f;
    margin-top: 15px;
}
</style>
</head>

<body>

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

</body>
</html>
