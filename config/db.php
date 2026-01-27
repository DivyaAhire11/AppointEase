<?php
// PostgreSQL Database Connection
$host = "localhost";
$port = 5432;
$database = "hospital";
$user = "postgres";
$password = "tybcs";

$conn = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

if (!$conn) {
   die("Error: Database connection failed - " . pg_last_error());
}

// Set the connection to use UTF-8
pg_set_client_encoding($conn, "UTF8");
?>
