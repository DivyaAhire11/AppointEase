<?php
include "../config/db.php";
$success = false;
$error = "";

if (isset($_POST['submit'])) {
   $name = $_POST['patient_name'];
   $email  = $_POST['email'];
   $doctor = $_POST['doctor'];
   $date   = $_POST['date'];
   $time   = $_POST['time'];

   $query = "INSERT INTO appointments (patient_name , email ,doctor , appoint_date ,appoint_time) VALUES ($1,$2,$3,$4,$5)";

   $result = pg_query_params($conn, $query, [$name, $email, $doctor, $date, $time]);

   if ($result) {
      $success = true;
   } else {
      $error = "Error booking appointment: " . pg_last_error($conn);
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
      body {
         font-family: Arial, sans-serif;
         background: linear-gradient(135deg, #e0f7fa 0%, #b2dfdb 100%);
         min-height: 100vh;
         padding-top: 70px;
         display: flex;
         align-items: center;
         justify-content: center;
      }

      .popup {
         width: 350px;
         padding: 30px;
         background-color: #e8ffe8;
         border: 2px solid #4CAF50;
         border-radius: 8px;
         text-align: center;
         font-family: Arial;
         box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      }

      .popup h3 {
         color: #4CAF50;
         margin-bottom: 10px;
      }

      .popup p {
         color: #333;
         margin-bottom: 20px;
      }

      .popup.error {
         background-color: #ffe8e8;
         border-color: #f44336;
      }

      .popup.error h3 {
         color: #f44336;
      }

      a {
         padding: 10px 20px;
         background-color: #4CAF50;
         color: white;
         border: none;
         border-radius: 5px;
         text-decoration: none;
         display: inline-block;
         transition: all 0.3s ease;
      }

      a:hover {
         background-color: #45a049;
         transform: scale(1.05);
      }

      .popup.error a {
         background-color: #f44336;
      }

      .popup.error a:hover {
         background-color: #da190b;
      }
   </style>
</head>

<body>
   <?php
   if ($success): ?>
      <div class="popup">
         <h3> Success</h3>
         <p>Your appointment has been booked successfully.</p>
         <a href="../index.php">Back to Home</a>
      </div>
   <?php elseif (!empty($error)): ?>
      <div class="popup error">
         <h3> Error</h3>
         <p><?php echo htmlspecialchars($error); ?></p>
         <a href="./bookAppoint.php">Try Again</a>
      </div>
   <?php endif; ?>
</body>

</html>