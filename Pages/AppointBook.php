<?php
   if(isset($_POST['submit'])){
    $patient = $_POST['patient_name'];
    $email = $_POST['email'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
   

    if($patient && $email && $doctor && $date  && $time){
        echo "Appointment booked successfully!";
    }else{
         echo "Please fill all fields.";
    }
   }
?>
<!-- 
Database-> 
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(100),
    email VARCHAR(100),
    doctor VARCHAR(100),
    date DATE,
    time TIME
);


include '../config/db.php'; // database connection

$sql = "INSERT INTO appointments 
(patient_name, email, doctor, date, time)
VALUES ('$patient', '$email', '$doctor', '$date', '$time')";

mysqli_query($conn, $sql);

/Pages
   └── bookAppoint.php
/includes
   └── navbar.php
/config
   └── db.php -->
