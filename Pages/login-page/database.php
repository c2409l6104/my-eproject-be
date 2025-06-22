<?php
$dbUser = "root";
$dbPassword = "";
$dbName = "eproject";
$servername = "localhost";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $dbUser, $dbPassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>  