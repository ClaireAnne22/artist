<?php

$servername = "localhost";
$username = "root";
$password="";
$dbname = "group4";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //echo "Connected successfully";
} catch(PDOException $e){
	echo "Unexpected error has been occurred!";
}
	
?> 
