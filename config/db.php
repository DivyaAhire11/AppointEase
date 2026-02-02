<?php

$DB_HOST = 'localhost';
$DB_PORT = 5432;
$DB_NAME = 'hospital';
$DB_USER = 'postgres';
$DB_PASSWORD = 'tybcs';

//database connection
$conn = pg_connect(
    "host =" . $DB_HOST . " port = " . $DB_PORT . " dbname=" . $DB_NAME .
        " user=" . $DB_USER .
        " password=" . $DB_PASSWORD
);

// Check connection
if (!$conn) {
    die("Database connection failed. Please try again later");
}
