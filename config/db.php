<?php 
 $conn = pg_connect("host=localhost dbname=hospital user=postegres passward=tybcs");
 
 if(!$conn){
    echo "Database connection failed";
 }else{
    echo "Database connect successfully";
 }
 ?>