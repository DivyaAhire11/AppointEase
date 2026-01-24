<?php
include "db.php";
$id = $_GET['id'];

pg_query_params(
    $conn,
    "DELETE FROM appointments WHERE id=$1",
    array($id)
);

header("Location: my_appointments.php");
?>
