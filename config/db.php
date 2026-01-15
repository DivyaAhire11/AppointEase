<?php
$conn = pg_connect("
 host=localhost 
 port=5432
 dbname=hospital 
 user=postgres 
 password=tybcs");

if (!$conn) {
   echo "Database connection failed";
} else {
   die("Database connection failed");
}
