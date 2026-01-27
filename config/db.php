<?php
// PostgreSQL Database Connection
$host = "localhost";
$port = 5432;
$database = "hospital";
$user = "postgres";
$password = "tybcs";

$conn = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

if (!$conn) {
   die("Error: Database connection failed - ");
}

?>
