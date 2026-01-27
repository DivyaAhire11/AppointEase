 <?php
// session_start();
// include "db.php";

// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit;
// }

// $doctor_id = $_GET['doctor_id'];
// $message = "";

// if (isset($_POST['book'])) {
//     $date = $_POST['date'];
//     $time = $_POST['time'];
//     $patient_id = $_SESSION['user_id'];

//     $query = "INSERT INTO appointments 
//               (patient_id, doctor_id, appointment_date, appointment_time)
//               VALUES ($1, $2, $3, $4)";

//     $result = @pg_query_params(
//         $conn,
//         $query,
//         array($patient_id, $doctor_id, $date, $time)
//     );

//     if ($result) {
//         $message = "✅ Appointment booked successfully!";
//     } else {
//         $message = "❌ This time slot is already booked. Please choose another.";
//     }
// }
?>
<!--
<!DOCTYPE html>
<html>
<head>
<title>Book Appointment</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #e0f7fa;
}

.box {
    max-width: 400px;
    margin: 80px auto;
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

h2 {
    color: #006d6f;
    text-align: center;
}

input, button {
    width: 100%;
    padding: 12px;
    margin-top: 15px;
}

button {
    background: #009688;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

.message {
    text-align: center;
    margin-top: 15px;
    font-weight: bold;
}
</style>
</head>

<body>

<div class="box">
    <h2>Book Appointment</h2>

    <form method="POST">
        <label>Date</label>
        <input type="date" name="date" required>

        <label>Time</label>
        <input type="time" name="time" required>

        <button type="submit" name="book">Confirm Booking</button>
    </form>

    <div class="message"><?php // echo $message; ?></div>
</div>

</body>
</html> -->
