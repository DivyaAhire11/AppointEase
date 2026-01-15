<?php
include "../config/db.php";
$success = false;

if (isset($_POST['submit'])) {
   $name = $_POST['patient_name'];
   $email  = $_POST['email'];
   $doctor = $_POST['doctor'];
   $date   = $_POST['date'];
   $time   = $_POST['time'];

   $query = "INSERT INTO appointments (patient_name , email ,doctor , appoint_date ,appoint_time) VALUES ($1,$2,$3,$4,$5)";

   $result = pg_query_params($con, $query, [$name, $email, $doctor, $date, $time]);

   if ($result) {
      $success = true;
   } else {
      echo " Error booking appointment. ";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Booking Status</title>
   <style>
      .popup {
         width: 300px;
         padding: 20px;
         background-color: #e8ffe8;
         border: 1px solid #4CAF50;
         border-radius: 8px;
         text-align: center;
         margin: 100px auto;
         font-family: Arial;
      }

      a {
         padding: 5px 10px;
         border: 1px solid #4CAF50;
         border-radius: 5px;
         text-decoration: none;
      }
   </style>
</head>
<!-- style="background-color: cadetblue;" -->

<body>
   <?php
   if ($success): ?>
      <div class="popup">
         <h3>Success</h3>
         <p>Your appointment has been booked successfully.</p>
         <a href="../index.php">OK</a>
      </div>
   <?php endif; ?>
</body>

</html>