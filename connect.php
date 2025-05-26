<?php
$username = "root";
$password = "";
$database = "eproject";
$servername = "localhost";

try {
  $conn = new PDO("mysql:host=$servername;dbname=eproject", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>  